<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/6
 * Time: 22:32
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = ['role_id', 'menu_id'];
}