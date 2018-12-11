<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/10
 * Time: 21:14
 */

namespace App\Http\Controllers\Admin\Article;


use App\Http\Controllers\Admin\BaseController;
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

    public function index()
    {
        $page_title = '文章分类';
        $lists = $this->repository->getLists();
        return view('admin.article.category.index',compact('page_title', 'lists'));
    }


    public function edit(Request $request)
    {
        try{
            if(empty($request->id)){

                $page_title = '添加分类';
                return view('admin.article.category.edit',compact('page_title'));
            } else {

                $page_title = '编辑分类';
                if(intval($request->id) <= 0){
                    throw new \Exception('请求参数错误');
                }

                $data = $this->repository->find($request->id);
                return view('admin.article.category.edit', compact('page_title', 'data'));
            }

        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage());
        }

    }

    public function store(Request $request)
    {
        try{
            Log::info($request->all());

            return ApiResponse::success([], '操作成功');
        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage());
        }

    }
}