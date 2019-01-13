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
use App\Repositories\System\RoleRepository;
use App\Repositories\User\AdminRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRoleRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    protected $adminRepository;

    /**
     * @var
     */
    protected $roleRepository;

    /**
     * @var
     */
    protected $userRoleRepository;

    public function __construct(
        UserRepository $repository,
        RoleRepository $roleRepository,
        AdminRepository $adminRepository,
        UserRoleRepository $userRoleRepository
    )
    {
        parent::__construct();
        $this->repository = $repository;
        $this->roleRepository = $roleRepository;
        $this->adminRepository = $adminRepository;
        $this->userRoleRepository = $userRoleRepository;
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
                'url'    => url('user/setRole?uid=' . $request->id),
                'title'  => '设置角色',
                'width'  => '30%',
                'height' => '450px'
            );
            return ApiResponse::success($returnData);
        }

        $lists = $this->adminRepository->getLists($request);
        return view('admin.user.index', compact('page_title', 'lists'));
    }

    /**
     *  设置角色
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setRole(Request $request)
    {
        try{
            if(empty($request->uid) || intval($request->uid) <= 0) {
                throw new \Exception('请求参数错误,请重新请求');
            }

            $uid = $request->uid;
            $is_edit = 0;

            $roles = $this->roleRepository->all(['id', 'name'])->toArray();

            //获取当前用户的角色
            $userRole = $this->userRoleRepository->getUserRoleByUid($request->uid);

            if($userRole){
                $is_edit = 1;
                $userRole = explode(',',$userRole['role_id']);
            }

            return view('admin.user.edit_role', compact('uid', 'is_edit', 'roles' , 'userRole'));
        } catch (\Exception $exception){
            return redirect('admin/layerError')->with('error', $exception->getMessage());
        }
    }

    /**
     * 保存用户角色
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeUserRole(Request $request)
    {
        try{
            $roles = (array)$request->roles;
            if($roles) {
                sort($roles);
                $roles = implode(',', $roles);
            }

            $data = array(
                'uid' => $request->uid,
                'role_id' => $roles
            );

            if($request->is_edit) {
                $this->userRoleRepository->update(array('role_id' => $roles), array('uid' => $request->uid));
            } else {
                $this->userRoleRepository->create($data);
            }
            return ApiResponse::success();
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage());
        }
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
            DB::beginTransaction();
            $this->repository->delete($request->id, true);
            $hasRole = $this->userRoleRepository->getUserRoleByUid($request->id);

            if($hasRole){
                $this->userRoleRepository->deleteUserRole($request->id);
            }
            DB::commit();
            return ApiResponse::success();
        } catch (\Exception $exception){
            DB::rollBack();
            return ApiResponse::error($exception->getMessage());
        }
    }
}