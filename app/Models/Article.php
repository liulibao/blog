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
    const IS_RECOMMEND = 1;

    protected $fillable = [
            'uid','title','image',
            'path','keyword','category_id',
            'tag_id', 'contents','sort',
            'is_top','is_comment','is_recommend'
        ];

    /**
     * 文章类型
     * @return array
     */
    public function types()
    {
        return
            array('原创', '转载', '翻译');
    }
}