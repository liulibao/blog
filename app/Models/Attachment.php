<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/29
 * Time: 14:46
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['original', 'filename', 'path', 'size', 'ext', 'mime_type'];
}