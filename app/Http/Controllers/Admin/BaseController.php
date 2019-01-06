<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/6
 * Time: 21:55
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    //获取IP
    public function getIP()
    {
        $request = request();
        $ip = ip2long($request->getClientIp());
        return  bindec(decbin($ip));
    }

}