<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/8
 * Time: 21:30
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
            'uid','title','image',
            'path','keyword','category_id',
            'tag_id', 'contents','sort',
            'is_top','is_comment','is_recommend'
        ];

    /**
     * 文章分类
     * @return array
     */
    public function tags()
    {
        return
            array('原创', '转载', '翻译');
    }
}