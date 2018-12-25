<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/25
 * Time: 21:51
 */

namespace App\Http\Controllers\Admin\User;


use App\Http\Controllers\Admin\BaseController;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    //管理员列表
    public function index(Request $request)
    {
        $page_title = '管理员列表';
        $lists = $this->repository->getLists($request);
        return view('admin.user.index', compact('page_title', 'lists'));
    }

    //用户列表
    public function subscriber(Request $request)
    {
        $page_title = '用户列表';
        $lists = $this->repository->getLists($request, false);
        return view('admin.user.subscriber', compact('page_title', 'lists'));
    }
}