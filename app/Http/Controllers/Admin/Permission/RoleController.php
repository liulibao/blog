<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/1
 * Time: 16:53
 */

namespace App\Http\Controllers\Admin\Permission;


use App\Http\Controllers\Admin\BaseController;
use App\Repositories\Permission\RoleRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    /**
     * @var
     */
    protected $repository;

    public function __construct( RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 列表首页
     * @return mixed
     */
    public function index()
    {
        $page_title = '角色列表';
        $lists = $this->repository->getLists();

        return view('admin.permission.role.index', compact('page_title', 'lists'));
    }

    /**
     * 编辑页面
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request)
    {
        try{
            $page_title = '添加角色';

            return view('admin.permission.role.edit', compact('page_title'));
        } catch (\Exception $exception) {

            return redirect('admin/error')->with('error', $exception->getMessage());
        }
    }

    /**
     * 保存数据
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        // TODO: Implement store() method.
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