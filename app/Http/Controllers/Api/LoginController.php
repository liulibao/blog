<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/5
 * Time: 13:40
 */

namespace App\Http\Controllers\Api;


use App\Traits\ApiResponse;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

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

            $user = (new User())->where('email', $request->email)->first();
            if(!$user){
                return ApiResponse::error('用户不存在');
            }
            if (Hash::check($request->password, $user->password) === false) {
                return ApiResponse::error('用户密码错误!');
            }

            if(! $token = Auth::guard('api')->attempt($request->all())){
                return ApiResponse::error('登陆异常');
            }

            $token = 'bearer' . $token;
            return ApiResponse::success(compact('token'));

        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }

    /**
     * 退出登陆
     */
    public function logout()
    {
        try{
            Auth::guard('api')->logout();
            return ApiResponse::success();
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }

}