<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/1
 * Time: 16:53
 */

namespace App\Http\Controllers\Admin\System;


use App\Http\Controllers\Admin\BaseController;
use App\Http\Request\RoleRequest;
use App\Models\RolePermission;
use App\Repositories\System\MenuRepository;
use App\Repositories\System\RolePermissionRepository;
use App\Repositories\System\RoleRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleController extends BaseController
{
    /**
     * @var
     */
    protected $repository;

    /**
     * @var
     */
    protected $menuRepository;

    /**
     * @var
     */
    protected $rolePermissionRepository;

    public function __construct(
        RoleRepository $repository,
        MenuRepository $menuRepository,
        RolePermissionRepository $rolePermissionRepository

    )
    {
        $this->repository = $repository;
        $this->menuRepository = $menuRepository;
        $this->rolePermissionRepository = $rolePermissionRepository;
    }

    /**
     * 列表首页
     * @return mixed
     */
    public function index(Request $request)
    {
        $page_title = '角色列表';

        if(!empty($request->id) && intval($request->id) > 0){
            $returnData = array(
                'url' => url('system/role/editPermission?rid=' . $request->id),
                'title' => '设置权限',
                'width'  => '60%',
                'height' => '450px'
            );
            return ApiResponse::success($returnData);
        }

        $lists = $this->repository->getLists();
        return view('admin.system.role.index', compact('page_title', 'lists'));
    }

    /**
     * 编辑页面
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request)
    {
        try{
            if(empty($request->id)){
                $page_title = '添加角色';
            } else {
                $page_title = '修改角色';

                if (intval($request->id) <= 0) {
                    throw new \Exception('请求参数有误');
                }

                $data = $this->repository->find($request->id);
            }

            return view('admin.system.role.edit', compact('page_title', 'data'));
        } catch (\Exception $exception) {

            return redirect('admin/error')->with('error', $exception->getMessage());
        }
    }

    /**
     *  设置权限
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPermission(Request $request)
    {
        try{
            if(empty($request->rid) || intval($request->rid) <= 0) {
                throw new \Exception('请求参数错误,请重新请求');
            }

            $is_edit = 0;
            $rid = $request->rid;

            $menu = $this->menuRepository->getMenu()->toArray();
            $menus = format_data_tree($menu);

            //获取当前角色拥有的权限
            $permission = $this->rolePermissionRepository->getPermissionByRoleId($request->rid);
            if($permission){
                $is_edit = 1;
                $permission = json_decode($permission['menu_id'], true);
            }

            return view('admin.system.role.edit_permission', compact('rid', 'is_edit', 'menus', 'permission'));
        } catch (\Exception $exception){
            return redirect('admin/layerError')->with('error', $exception->getMessage());
        }
    }

    /**
     * 保存权限
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePermission(Request $request)
    {
        try{
            $permission = (array)$request->permission;
            if($permission) {
                sort($permission);
            }

            $data = array(
                'role_id' => $request->rid,
                'menu_id' => json_encode($permission)
            );

            if($request->is_edit) {
                 $this->rolePermissionRepository->update(array('menu_id' => json_encode($permission)), array('role_id' => $request->rid));
            } else {
                $this->rolePermissionRepository->create($data);
            }
            return ApiResponse::success();
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage());
        }
    }

    /**
     * 保存数据
     * @param RoleRequest $request
     * @return mixed
     */
    public function store(RoleRequest $request)
    {
        try{
            if(empty($request->id)){

                $this->repository->create(array_filter($request->all()));
            } else {

                if(intval($request->id) <= 0){
                    throw new \Exception('请求参数错误');
                }

                $this->repository->update(array_filter($request->all()), $request->id);
            }

            return ApiResponse::success();
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }

    /**
     * 删除操作
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        try{
            if ($request->id && intval($request->id) < 0 ) {
                throw new \Exception('请求参数错误');
            }

            $this->repository->delete($request->id, true);
            return ApiResponse::success();
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage());
        }
    }
}