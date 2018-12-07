<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/5
 * Time: 14:58
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class HomeController extends Controller
{

    //测试获取用户信息
    public function index()
    {
        try{
            $user = auth('api')->user();
            return ApiResponse::success(compact('user'));
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }
}