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
//        'login',
    ];

    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //判断权限
//        if(in_array(getCurrentUrl(), $this->except)) {
//            return $next($request);
//        }

        //判断是否登陆
        if(!session('user')) {
            return redirect('/login');
        }

        $loginService = new LoginService();
        $isAuth = $loginService->isHasPermission();
        $menus = $loginService->getUserHasMenu();
        $router_prefix = explode('/', getCurrentUrl())[0];

        if(!$isAuth) {
            if(isPost() || isAjax()) {
                return ApiResponse::error('您无此权限');
            } else {
                $url = isset($request->layer) ? 'admin/layerError' : 'admin/error';
                return redirect($url)->with('error', '您无此权限');
            }
        }

        view()->share('userHasMenu', $menus);
        view()->share('request_prefix', $router_prefix);

        return $next($request);
    }
}