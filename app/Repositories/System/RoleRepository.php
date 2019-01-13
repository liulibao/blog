<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/1
 * Time: 18:45
 */

namespace App\Repositories\System;


use App\Models\Role;
use App\Repositories\BaseRepository;
use Illuminate\Foundation\Application as App;

class RoleRepository extends BaseRepository
{

    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * 获取列表
     */
    public function getLists()
    {
        return $this->model->where('deleted_at', 0)
            ->orderBy('id', 'desc')
            ->paginate();
    }
}