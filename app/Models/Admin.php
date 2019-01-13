<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/11
 * Time: 20:40
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    const IS_ADMIN = 1; //管理员

    protected $table = 'users';

    protected $fillable = [
        'username', 'name', 'email', 'password', 'mobile', 'is_admin', 'remarks'
    ];
}