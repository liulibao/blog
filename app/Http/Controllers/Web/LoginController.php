<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/5
 * Time: 13:40
 */

namespace App\Http\Controllers\Web;


use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoginController extends BaseController
{

    public function test()
    {
        return '123456';
    }

    /**
     * 测试登陆
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try{
            if (empty($request->all())) {
                return ApiResponse::error('非法访问');
            }
            $rules = [
                'email' => 'required|email',
                'password' => 'required|min:6'
            ];
            $messages = [
                'email.required' => '请输入邮箱',
                'email.email' => '请输入正确的邮箱格式',
                'password.required' => '请输入密码',
                'password.min' => '密码长度至少6位'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return ApiResponse::error($validator->errors()->first());
            }

            return ApiResponse::success();
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }
}