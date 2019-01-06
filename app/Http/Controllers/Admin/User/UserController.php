<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/25
 * Time: 21:51
 */

namespace App\Http\Controllers\Admin\User;


use App\Http\Controllers\Admin\BaseController;
use App\Repositories\System\MenuRepository;
use App\Repositories\User\UserRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends BaseController
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var
     */
    protected $menuRepository;

    public function __construct(UserRepository $repository, MenuRepository $menuRepository)
    {
        $this->repository = $repository;
        $this->menuRepository = $menuRepository;
    }

    /**
     * 管理员列表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $page_title = '管理员列表';

        if(!empty($request->id) && intval($request->id) > 0){
            $returnData = array(
                'url' => url('user/editRole?uid=' . $request->id),
                'title' => '设置角色'
            );
            return ApiResponse::success($returnData);
        }

        $lists = $this->repository->getLists($request);
        return view('admin.user.index', compact('page_title', 'lists'));
    }

    /**
     *  设置角色
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editRole(Request $request)
    {
        try{
            if(empty($request->uid) || intval($request->uid) <= 0) {
                throw new \Exception('请求参数错误,请重新请求');
            }
            $uid = $request->uid;

            $menu = $this->menuRepository->getMenu()->toArray();
            $menus = format_data_tree($menu);

            return view('admin.user.edit_role', compact('uid', 'menus'));
        } catch (\Exception $exception){
            return redirect('admin/layerError')->with('error', $exception->getMessage());
        }
    }

    /**
     * 保存用户角色
     * @param Request $request
     */
    public function storeUserRole(Request $request)
    {

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

            $this->repository->delete($request->id, true);

            return ApiResponse::success();
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }
}