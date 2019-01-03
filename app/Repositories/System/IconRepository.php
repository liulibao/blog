<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2019/1/3
 * Time: 10:07
 */

namespace App\Repositories\System;


use App\Models\Icon;
use App\Repositories\BaseRepository;

class IconRepository extends BaseRepository
{

    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return Icon::class;
    }

    /**
     * 获取文件列表
     */
    public function getLists()
    {
        $result = $this->model;

        if(!empty(request('name'))) {
            $result->where('name', 'like', '%'.request('name').'%');
        }

        return $result->orderBy('id', 'asc')->get();
    }
}