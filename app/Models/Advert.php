<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/26
 * Time: 19:31
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $fillable = [];

    /**
     * 广告分类
     * @return array
     */
    public function types()
    {
        return [
            '1'=>'幻灯片'
        ];
    }
}