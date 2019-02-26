<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/2/24
 * Time: 12:04
 */

namespace App\Models\Diy;


use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $connection = 'mysql_line';
}