<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/2/16
 * Time: 14:30
 */

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Repositories\Article\ArticleRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $article = $this->articleRepository->getWebLists($request);
        return view('web.index.index', compact('article'));
    }
}