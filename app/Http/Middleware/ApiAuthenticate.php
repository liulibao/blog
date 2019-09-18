<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class ApiAuthenticate extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try{
            if (!$token = $request->header('authorization')) {
                throw new \Exception('token不存在，非法请求！', 403);
            }

            if(!Str::startsWith($token, 'Bearer ')) {
                throw new \Exception('token格式错误，非法请求！', 403);
            }

            // 验证是否登录
            if (Auth::guard('api')->guest()) {
                if ($request->ajax() || $request->wantsJson()) {
                    throw new \Exception('请先登录！', 403);
                } else {
                    throw new \Exception('请先登录！', 403);
                }
            }
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage(), $exception->getCode());
        }

        return $next($request);
    }
}
