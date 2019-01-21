<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/21
 * Time: 22:02
 */

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Log;


class AdminAuthenticate
{
    /**
     * 设置路由黑名单 设置的是url()中的路由
     * @var array
     */
    protected $except = [
        'login','/login'
    ];

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        Log::info('我走的是后台');
        Log::info(json_encode(session('user')));
        if(!session('user')){
            return redirect('/login');
        }
        return $next($request);
    }
}