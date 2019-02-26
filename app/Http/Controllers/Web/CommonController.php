<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/2/17
 * Time: 22:16
 */

namespace App\Http\Controllers\Web;


class CommonController extends BaseController
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