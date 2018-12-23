<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/8
 * Time: 21:23
 */

namespace App\Http\Controllers\Admin\Article;


use App\Http\Controllers\Admin\BaseController;
use App\Http\Request\ArticleRequest;
use App\Repositories\Article\ArticleCategoryRepository;
use App\Repositories\Article\ArticleRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    protected $repository;

    protected $categoryRepository;

    public function __construct(
        ArticleRepository $repository,
        ArticleCategoryRepository $categoryRepository
    )
    {
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $page_title = '文章列表';
        $lists = $this->repository->getLists();
        $tags = $this->repository->getTags();
        $category = $this->categoryRepository->getAll()->toArray();
        $category = format_array($category, 'id', 'name');
        return view('admin.article.index', compact('page_title', 'lists', 'tags', 'category'));
    }


    public function edit()
    {
        $page_title = '添加文章';
        $tags = $this->repository->getTags();
        $category = $this->categoryRepository->getAll();
        return view('admin.article.edit', compact('page_title', 'tags', 'category'));
    }

    public function store(ArticleRequest $request)
    {
        try{
            if(empty($request->keyword)){
                unset($request['keyword']);
            }

            if(empty($request->path)){
                unset($request['path']);
            }

            $this->repository->create($request->all());
            return ApiResponse::success();
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }

    public function delete(Request $request)
    {

    }
}