<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/6
 * Time: 21:54
 */

namespace App\Http\Controllers\Admin;


use App\Repositories\User\AdminRepository;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * @var
     */
    protected $repository;

    public function __construct(AdminRepository $repository)
    {
        parent::__construct();
    }

    /**
     * 首页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.home.index');
    }

    /**
     * 错误页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function error()
    {
        return view('admin.errors.error');
    }

    /**
     * 使用layer 弹层报错提示
     */
    public function layerError()
    {
        return view('admin.errors.layer_error');
    }
}