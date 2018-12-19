<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/19
 * Time: 22:25
 */

namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class ArticleCategoryRequest extends FormRequest
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
            'name' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '分类名称不能为空'
        ];
    }
}