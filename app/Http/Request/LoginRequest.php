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
    public function authorization()
    {
        return true;
    }

    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }
}