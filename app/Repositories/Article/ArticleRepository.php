<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/11/12
 * Time: 13:51
 */

namespace App\Repositories\Article;


use App\Models\Article;
use App\Repositories\BaseRepository;
use Illuminate\Foundation\Application as App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ArticleRepository extends BaseRepository
{
    /**
     * 设置文章列表缓存key
     * @var
     */
    protected $article_cache_key;

    /**
     * 设置最新文章列表缓存key
     * @var
     */
    protected $article_last_cache_key;

    /**
     * 设置文章默认图片
     * @var string
     */
    protected $article_default_logo = 'web/images/default.png';

    /**
     * 设置缓存时间
     * @var int
     */
    protected $cache_time = 3600 * 24 * 30;


    public function model()
    {
        return Article::class;
    }

    /**
     * 获取文章tag
     * @return mixed
     */
    public function getTypes()
    {
        return $this->model->types();
    }

    /**
     * 文章列表
     * @param Request $request
     * @return mixed
     */
    public function getLists(Request $request)
    {
        $result = $this->model;
        if (!empty($request->title)) {
            $result = $result->where('title', 'like', '%' . $request->title . '%');
        }

        if (!empty($request->category_id)) {
            $result = $result->where('category_id', $request->category_id);
        }

        return $result->orderBy('deleted_at', 'asc')
            ->orderBy('id', 'desc')
            ->paginate();
    }

    /**
     * 前台获取文章列表
     * @param Request $request
     * @return mixed
     */
    public function getWebLists(Request $request)
    {
        $data = $this->model->where('articles.deleted_at', 0)
            ->select('articles.id', 'articles.title', 'articles.uid', 'articles.image', 'articles.read_num','articles.type_id',
                'articles.comment_num', 'articles.contents', 'articles.created_at', 'articles.deleted_at', 'users.username')
            ->leftJoin('users', 'users.id', '=', 'articles.uid')
            ->orderBy('articles.id', 'desc')
            ->paginate();

        if ($data) {
            $data = $data->toArray();
            foreach ($data['data'] as $k => &$item) {
                $data['data'][$k]['summary'] = getSummary($item['contents']);
                $article_logo = !empty($item['image']) ?  $item['image'] : (grabPictures($item['contents']) ? grabPictures($item['contents']) : $this->article_default_logo);
                $data['data'][$k]['image'] = asset($article_logo);
            }
        }

        return $data;
    }

    /**
     * 获取文章详情
     * @param $article_id
     * @return mixed
     */
    public function getArticleDetail($article_id)
    {
        $this->article_cache_key = 'article_cache_key_' . $article_id;

        $data = getCache($this->article_cache_key);

        $map = array(
            'articles.deleted_at' => 0,
            'articles.id' => $article_id
        );

        if ($data === null) {
            $data = $this->model->where($map)
                ->select('articles.id', 'articles.title', 'articles.uid', 'articles.image', 'articles.read_num','articles.type_id',
                        'articles.comment_num', 'articles.contents', 'articles.created_at', 'users.username', 'users.name')
                ->leftJoin('users', 'users.id', '=', 'articles.uid')
                ->first();

            if ($data) {
                $data = $data->toArray();
                $data['summary'] = getSummary($data['contents']);
                setCache($this->article_cache_key, $data, 3600 * 24 * 30);
            }
        }

        return $data;
    }

    /**
     * 统计文章阅读量/统计文章的点赞量/统计文章的评论数
     * @param $article_id
     * @param string $type read_num/like_num/comment_num
     * @param string $increments 增加数值
     */
    public function countArticleTypeNum($article_id, $type = 'read_num', $increments = '')
    {
        if($increments) {
            $this->model->where('id', $article_id)->increment($type, $increments);
        } else {
            $this->model->where('id', $article_id)->increment($type);
        }
        $this->article_cache_key = 'article_cache_key_' . $article_id;
        delCache($this->article_cache_key);
    }
}