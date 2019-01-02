<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/2
 * Time: 21:55
 */

namespace App\Repositories\System;


use App\Models\Menu;
use App\Repositories\BaseRepository;

class MenuRepository extends BaseRepository
{

    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return Menu::class;
    }

    /**
     * 首页列表
     */
    public function getLists()
    {
        return $this->model->where('deleted_at', 0)
            ->orderBy('id', 'desc')
            ->paginate();
    }
}