<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/26
 * Time: 19:31
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Advert extends Model
{
    protected $fillable = ['uid', 'title', 'attachment_id', 'type_id', 'remarks'];

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

    /**
     * 获取附件
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function attachment()
    {
        return $this->hasOne(Attachment::class, 'id', 'attachment_id')
            ->select('id', 'original', 'filename', 'size', 'path');
    }
}