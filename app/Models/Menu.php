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
   protected $fillable = ['name', 'pid', 'is_show', 'sort', 'remarks'];

}