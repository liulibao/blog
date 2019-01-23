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
        'login',
        'test/icons'
    ];

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(in_array(getCurrentUrl(), $this->except)) {
            return $next($request);
        }

        if(!session('user')){
            return redirect('/login');
        }

        return $next($request);
    }
}