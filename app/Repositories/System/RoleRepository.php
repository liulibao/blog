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

    /**
     * 获取用户角色权限
     * @param $uid
     * @return mixed
     */
    public function getUserRolePermission($uid)
    {
        return $this->model
            ->leftJoin('user_roles', 'user_roles.role_id', '=', 'roles.id')
            ->select('roles.id','roles.name','roles.sort', 'user_roles.role_id')
            ->where('user_roles.uid', $uid)
            ->with('permission')
            ->first();
    }


}