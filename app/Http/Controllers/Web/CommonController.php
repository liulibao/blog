<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/2/17
 * Time: 22:16
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class CommonController extends Controller
{
    /**
     * 错误页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function error()
    {
        return view('web.errors.error');
    }
}