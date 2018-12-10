<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/8
 * Time: 21:30
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $fillable = ['id','name','use_num','article_ids'];
}