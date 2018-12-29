<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/10
 * Time: 21:14
 */

namespace App\Http\Controllers\Admin\Article;


use App\Http\Controllers\Admin\BaseController;
use App\Http\Request\ArticleCategoryRequest;
use App\Repositories\Article\ArticleCategoryRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArticleCategoryController extends BaseController
{
    protected $repository;

    public function __construct(ArticleCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    //文章分类列表
    public function index()
    {
        $page_title = '文章分类';
        $lists = $this->repository->getLists();
        return view('admin.article.category.index',compact('page_title', 'lists'));
    }

    //文章分类编辑
    public function edit(Request $request)
    {
        try{
            if(empty($request->id)){

                $page_title = '添加分类';
            } else {

                $page_title = '编辑分类';
                if(intval($request->id) <= 0){
                    throw new \Exception('请求参数错误');
                }

                $data = $this->repository->find($request->id);
            }

            return view('admin.article.category.edit', compact('page_title', 'data'));
        } catch (\Exception $exception) {
            $message = $exception->getMessage();
            return view('admin.errors.404', compact('message'));
        }

    }

    //文章分类保存
    public function store(ArticleCategoryRequest $request)
    {
        try{
            if(empty($request->id)){
                $this->repository->create($request->all());
            } else {
                $this->repository->update($request->all(), $request->id);
            }

            return ApiResponse::success();
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage());
        }

    }

    //文章分类删除
    public function delete(Request $request)
    {
        try{
            if(intval($request->id) <= 0){
                throw new \Exception('请求参数错误');
            }
            $this->repository->delete($request->id, true);
            return ApiResponse::success();
        }catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }
}