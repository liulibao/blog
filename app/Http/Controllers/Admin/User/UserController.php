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
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends BaseController
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 管理员列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page_title = '管理员列表';
        $lists = $this->repository->getLists($request);
        return view('admin.user.index', compact('page_title', 'lists'));
    }

    /**
     * 用户列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscriber(Request $request)
    {
        $page_title = '用户列表';
        $lists = $this->repository->getLists($request, false);
        return view('admin.user.subscriber', compact('page_title', 'lists'));
    }

    /**
     * 删除用户
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        try{
            if(intval($request->id) <= 0) {
                throw new \Exception('请求参数有误');
            }

            $status =$this->repository->delete($request->id, true);
            Log::info(json_encode($status));
            return ApiResponse::success();
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }
}