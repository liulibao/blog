<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class RefreshToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handlesss($request, Closure $next)
    {
        // 检查此次请求中是否带有 token，如果没有则抛出异常。
        $this->checkForToken($request);

        // 使用 try 包裹，以捕捉 token 过期所抛出的 TokenExpiredException  异常
        try {
            // 检测用户的登录状态，如果正常则通过
            if ($this->auth->parseToken()->authenticate()) {
                return $next($request);
            }

            throw new UnauthorizedHttpException('jwt-auth', '未登录');

        } catch (TokenExpiredException $exception) {

            // 此处捕获到了 token 过期所抛出的 TokenExpiredException 异常，
            //我们在这里需要做的是刷新该用户的 token 并将它添加到响应头中
            try {
                // 刷新用户的 token
                $token = $this->auth->setRequest($request)->parseToken()->refresh();
                // 使用一次性登录以保证此次请求的成功
                Auth::guard('api')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);
            } catch (JWTException $exception) {

                // 如果捕获到此异常，即代表 refresh 也过期了，用户无法刷新令牌，需要重新登录。
                throw new UnauthorizedHttpException('jwt-auth', $exception->getMessage(), $exception, $exception->getCode());
            }
        }


        // 在响应头中返回新的 token
        return $this->setAuthenticationHeader($next($request), $token);
//        return $next($request);

    }


    public function handle($request, Closure $next)
    {
        $newToken = null;
        $auth = $this->auth->parseToken();
        if (! $token = $this->auth->setRequest($request)->getToken()) {
            return response()->json([
                'code' => '2',
                'msg' => '无参数token',
                'data' => '',
            ]);
        }

        try {
            $user = $this->auth->parseToken()->authenticate($token);
            if (! $user) {
                return response()->json([
                    'code' => '2',
                    'msg' => '未查询到该用户信息',
                    'data' => '',
                ]);
            }
            $request->headers->set('Authorization','Bearer '.$token);
        } catch (TokenExpiredException $e) {
            try {
                sleep(rand(1,5)/100);
                $newToken = $this->auth->refresh($token);
                $request->headers->set('Authorization','Bearer '.$newToken); // 给当前的请求设置性的token,以备在本次请求中需要调用用户信息
                // 将旧token存储在redis中,30秒内再次请求是有效的
                \Redis::setex('token_blacklist:'.$token,30,$newToken);
            } catch (JWTException $e) {
                // 在黑名单的有效期,放行
                if($newToken = \Redis::get('token_blacklist:'.$token)){
                    $request->headers->set('Authorization','Bearer '.$newToken); // 给当前的请求设置性的token,以备在本次请求中需要调用用户信息
                    return $next($request);
                }
                // 过期用户
                return response()->json([
                    'code' => '2',
                    'msg' => '账号信息过期了，请重新登录',
                ]);
            }
        } catch (JWTException $e) {
            return response()->json([
                'code' => '2',
                'msg' => '无效token',
                'data' => '',
            ]);
        }
        $response = $next($request);

        if ($newToken) {
            $response->headers->set('Authorization', 'Bearer '.$newToken);
        }

        return $response;
    }

}
