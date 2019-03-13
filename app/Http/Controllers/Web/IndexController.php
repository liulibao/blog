<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/2/16
 * Time: 14:30
 */

namespace App\Http\Controllers\Web;


use App\Models\Diy\Article;
use App\Repositories\Advert\AdvertRepository;
use App\Repositories\Article\ArticleRepository;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    protected $articleRepository;

    protected $advertRepository;

    public function __construct(
        ArticleRepository $articleRepository,
        AdvertRepository $advertRepository
    )
    {
        parent::__construct();
        $this->articleRepository = $articleRepository;
        $this->advertRepository = $advertRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $article = $this->articleRepository->getWebLists($request);
        $advert = $this->getIndexAdvert();
        return view('web.index.index', compact('article', 'advert'));
    }

    /**
     * 获取广告图片
     */
    protected function getIndexAdvert()
    {
        return $this->advertRepository->getWebLists();
    }

    public function getAi()
    {
        $data = (new Article())->get()->toArray();
//        var_dump($data);
        foreach ($data as $item) {
//            var_dump($item);die;
            $in = array(
                'uid' => $item['uid'],
                'title' => $item['title'],
                'image' => $item['image'],
                'keyword' => $item['keyword'],
                'read_num' => $item['read_num'],
                'type_id' => $item['type'],
                'sort' => $item['sort'],
                'comment_num' => $item['comment_num'],
                'contents' => $item['contents'],
                'is_comment' => $item['is_comment'],
                'is_recommend' => $item['is_recommend'],
                'created_at' => $item['created_at'],
            );

            (new \App\Models\Article())->insert($in);
        }

    }
}