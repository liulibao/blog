<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/2/17
 * Time: 21:31
 */

namespace App\Http\Controllers\Web\Article;


use App\Http\Controllers\Controller;
use App\Repositories\Article\ArticleRepository;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    protected $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 文章详情
     * @param $article_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @internal param Request $request
     */
    public function detail($article_id)
    {
        if(!$article_id || intval($article_id) <= 0) {
            return ApiResponse::requestError();
        }

        $article = $this->repository->getArticleDetail($article_id);

        if(!$article) {
            return ApiResponse::requestError('文章被删除或者不存在');
        }

        return view('web.article.detail', compact('article'));
    }
}