<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/29
 * Time: 14:56
 */

namespace App\Repositories;


use App\Models\Attachment;

class AttachmentRepository extends BaseRepository
{

    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return Attachment::class;
    }
}