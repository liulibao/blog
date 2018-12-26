<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/26
 * Time: 14:01
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Dairy extends Model
{
    protected $fillable = ['uid', 'title', 'contents'];
}