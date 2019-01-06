<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/5
 * Time: 10:51
 */

namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'path' => 'required',
            'icon' => 'required_if:pid,0',
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
            'path.required' => '请填写路由',
            'icon.required_if' => '请选择目录ICON',
            'sort.integer' => '排序必须为整数'
        ];
    }
}