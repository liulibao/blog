<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/5
 * Time: 13:47
 */

namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => '用户名不能为空',
            'password.required' => '用户密码不能为空',
        ];
    }
}