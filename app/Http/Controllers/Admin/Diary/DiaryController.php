<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/26
 * Time: 14:00
 */

namespace App\Http\Controllers\Admin\Diary;


use App\Http\Controllers\Admin\BaseController;
use App\Http\Request\DiaryRequest;
use App\Repositories\Diary\DiaryRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class DiaryController extends BaseController
{
    protected $repository;

    public function __construct(DiaryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 获取列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page_title = '随心日记';
        $lists = $this->repository->getLists($request);
        return view('admin.diary.index', compact('page_title', 'lists'));
    }

    /**
     * 编辑日记
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        try{
            if(empty($request->id)) {
                $page_title = '添加日记';

                return view('admin.diary.edit', compact('page_title'));
            } else {
                $page_title = '编辑日记';

                if(intval($request->id) <= 0){
                    throw new \Exception('请求参数错误');
                }

                $lists = $this->repository->find($request->id);

                return view('admin.diary.edit', compact('page_title', 'lists'));
            }
        } catch (\Exception $exception){
            return redirect('admin/error')->with('error', $exception->getMessage());
        }
    }

    /**
     * 保存数据
     * @param DiaryRequest|Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DiaryRequest $request)
    {
        try{
            if(empty($request->id)) {
                $this->repository->create($request->all());
            } else {
                $this->repository->update($request->all(), $request->id);
            }
            return ApiResponse::success();
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }

    /**
     * 删除日记
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request)
    {
        try{
            if(intval($request->id) <= 0){
                throw new \Exception('请求参数错误');
            }
            $this->repository->delete($request->id, true);
            return ApiResponse::success();
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }
}