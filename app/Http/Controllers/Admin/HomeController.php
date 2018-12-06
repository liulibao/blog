<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/6
 * Time: 21:54
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * 首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('admin.home.index');
    }
}