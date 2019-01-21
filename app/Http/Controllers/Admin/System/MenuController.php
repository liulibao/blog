<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/1
 * Time: 17:02
 */

namespace App\Http\Controllers\Admin\System;


use App\Http\Controllers\Admin\BaseController;
use App\Http\Request\MenuRequest;
use App\Repositories\System\IconRepository;
use App\Repositories\System\MenuRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class MenuController extends BaseController
{

    /**
     * @var
     */
    protected $repository;

    /**
     * @var
     */
    protected $iconRepository;

    public function __construct( MenuRepository $repository, IconRepository $iconRepository)
    {
        parent::__construct();
        $this->repository = $repository;
        $this->iconRepository = $iconRepository;
    }

    /**
     * 列表首页
     * @return mixed
     */
    public function index()
    {
        $page_title = '目录列表';
        $lists = $this->repository->getLists();
        $lists = format_data_tree($lists);

        return view('admin.system.menu.index', compact('page_title', 'lists'));
    }

    /**
     * 编辑页面
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request)
    {
        try{
            $icons = $this->iconRepository->getLists();
            $menu = $this->repository->getMenu();
            $menu = format_data_tree($menu);

            if(empty($request->id)){
                $page_title = '添加目录';
            } else {
                $page_title = '修改目录';

                if (intval($request->id) <= 0) {
                    throw new \Exception('请求参数有误');
                }

                $data = $this->repository->find($request->id);
            }

            return view('admin.system.menu.edit', compact('page_title', 'icons', 'data', 'menu'));
        } catch (\Exception $exception) {

            return redirect('admin/error')->with('error', $exception->getMessage());
        }
    }

    /**
     * 保存数据
     * @param MenuRequest $request
     * @return mixed
     */
    public function store(MenuRequest $request)
    {
        try{

            if(empty($request->id)){

                $this->repository->create($request->all());
            } else {

                if(intval($request->id) <= 0){
                    throw new \Exception('请求参数错误');
                }

                $this->repository->update($request->all(), $request->id);
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