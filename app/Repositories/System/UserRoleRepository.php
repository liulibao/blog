<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/8
 * Time: 22:43
 */

namespace App\Repositories\System;


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
}