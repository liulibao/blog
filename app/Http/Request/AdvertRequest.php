<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/30
 * Time: 16:58
 */

namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class AdvertRequest extends FormRequest
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
            'title' => 'required',
            'type_id' => 'required|numeric',
            'attachment_id' => 'required|numeric',
            'remarks' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '广告标题不能为空',
            'type_id.required' => '广告类型不能为空',
            'type_id.numeric' => '广告类型参数错误',
            'attachment_id.required' => '广告图片不能为空',
            'attachment_id.numeric' => '广告图片参数错误',
            'remarks.required' => '广告内容不能为空',
        ];
    }
}