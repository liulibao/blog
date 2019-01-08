<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2019/1/8
 * Time: 13:50
 */

namespace App\Repositories\User;


use App\Models\UserRole;
use App\Repositories\BaseRepository;

class UserRoleRepository extends BaseRepository
{

    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return UserRole::class;
    }

    /**
     * 通过用户的uid获取对应的角色
     * @param $uid
     * @return mixed
     */
    public function getUserRoleByUid($uid)
    {
        return $this->model->select('role_id')
            ->where('uid', $uid)
            ->first();
    }

    /**
     * 删除
     * @param $uid
     */
    public function deleteUserRole($uid)
    {
        return  UserRole::where('uid', $uid)->delete();
    }
}