<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/26
 * Time: 16:09
 */

namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class DiaryRequest extends FormRequest
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
            'contents' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '请填写日记标题',
            'contents.required' => '请填写日记内容'
        ];
    }
}