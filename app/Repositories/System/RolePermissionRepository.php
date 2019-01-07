<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/7
 * Time: 21:55
 */

namespace App\Repositories\System;


use App\Models\RolePermission;
use App\Repositories\BaseRepository;

class RolePermissionRepository extends BaseRepository
{

    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return RolePermission::class;
    }

    /**
     * @param $role_id
     * @return array
     */
    public function getPermissionByRoleId($role_id)
    {
        return $this->model->select('menu_id')
            ->where('role_id', $role_id)
            ->first();
    }
}