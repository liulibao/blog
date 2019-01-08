<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/6
 * Time: 22:30
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_roles';
    protected $fillable = ['uid', 'role_id'];
}