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
use Illuminate\Support\HtmlString;

class ArticleController extends BaseController
{
    protected $repository;

    protected $categoryRepository;

    public function __construct(
        ArticleRepository $repository,
        ArticleCategoryRepository $categoryRepository
    )
    {
        parent::__construct();
        $this->repository = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * 文章列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $page_title = '文章列表';
        $lists = $this->repository->getLists($request);
        $types = $this->repository->getTypes();
        $category = $this->categoryRepository->getAll()->toArray();
        $category = format_array($category, 'id', 'name');
        return view('admin.article.index', compact('page_title', 'lists', 'types', 'category'));
    }

    /**
     * 添加/修改文章
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        try{
            $types = $this->repository->getTypes();
            $category = $this->categoryRepository->getAll();

            if(empty($request->id)){

                $page_title = '添加文章';
            } else {

                $page_title = '修改文章';
                if(intval($request->id) <= 0){
                    throw new \Exception('请求参数错误');
                }
                $lists = $this->repository->find($request->id);
            }

            return view('admin.article.edit', compact('page_title', 'types', 'category', 'lists'));
        } catch (\Exception $exception){
            $message = $exception->getMessage();
            return view('admin.errors.404', compact('message'));
        }
    }



    /**
     * 保存数据
     * @param ArticleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ArticleRequest $request)
    {
        try{
            if(empty($request->keyword)){
                unset($request['keyword']);
            }

            if(empty($request->path)){
                unset($request['path']);
            }

            if(isset($request->id)){
                $article_cache_key = 'article_cache_key_' . $request->id;
                $this->repository->update($request->all(), $request->id, $article_cache_key, true);
            } else {
                $this->repository->create($request->all());
            }

            return ApiResponse::success();
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }

    /**
     * 删除数据
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