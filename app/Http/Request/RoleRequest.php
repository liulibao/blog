<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/5
 * Time: 10:51
 */

namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => 'required',
            'sort' => 'integer'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '请填写目录名称',
            'sort.integer' => '排序必须为整数'
        ];
    }
}