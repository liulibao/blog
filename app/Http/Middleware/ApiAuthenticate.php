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
        if (!$token = $request->header('authorization')) {
            return ApiResponse::error("token不存在，非法请求！",403);
        }

        if(!Str::startsWith($token, 'Bearer ')) {
            return ApiResponse::error("token格式错误，非法请求！",403);
        }

        // 验证是否登录
        if (Auth::guard('api')->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return ApiResponse::error("请先登录",403);
            } else {
                return ApiResponse::error("请先登录123",403);
            }
        }

        return $next($request);
    }
}
