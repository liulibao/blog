<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/21
 * Time: 22:02
 */

namespace App\Http\Middleware;


use App\Services\Admin\LoginService;
use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
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
    public function handle(Request $request, Closure $next)
    {
        //判断权限
        if(in_array(getCurrentUrl(), $this->except)) {
            return $next($request);
        }

        //判断是否登陆
        if(!session('user')){
            return redirect('/login');
        }

        $isAuth = (new LoginService())->isHasPermission();
        if(!$isAuth) {
            if(isPost() || isAjax()) {
                return ApiResponse::error('您无此权限2');
            } else {
                $url = isset($request->layer) ? 'admin/layerError' : 'admin/error';
                return redirect($url)->with('error', '您无此权限3');
            }
        }

        $menus = (new LoginService())->getUserHasMenu();
        view()->share('userHasMenu', $menus);
        view()->share('request_prefix', getCurrentUrl());

        return $next($request);
    }
}