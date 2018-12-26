<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/23
 * Time: 21:23
 */

namespace App\Http\Request;


use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required' ,
            'type_id' => 'numeric|digits_between:0,2' ,
            'category_id' => 'numeric|min:1' ,
            'contents' => 'required',
            'sort' => 'required|numeric'
//           'keyword' => 'required' ,
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => '文章标题不能为空' ,
            'type_id.required' => '请选择正确文章归属' ,
            'type_id.digits_between' => '请选择正确文章归属' ,
            'category_id.numeric' => '请选择正确文章分类' ,
            'category_id.min' => '请选择正确文章分类' ,
            'contents.required' => '请填写文章内容',
            'sort.required' => '请填写排序号',
            'sort.numeric' => '排序号必须是数字',
//            'keyword' => 'required' ,
        ];
    }
}