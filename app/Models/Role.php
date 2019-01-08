<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/1
 * Time: 18:42
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'remarks', 'sort'];

    /**
     * 获取角色权限
     */
    public function permission()
    {
        return $this->hasOne(RolePermission::class, 'role_id', 'id');
    }

    /**
     * 获取用户的角色id
     */
    public function role()
    {
        return $this->belongsTo(UserRole::class, 'id', 'role_id');
    }

}