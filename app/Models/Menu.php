<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/2
 * Time: 21:52
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    const IS_SHOW = 1;

    protected $fillable = ['name', 'pid', 'path', 'depth', 'icon', 'is_show', 'sort', 'remarks'];

}