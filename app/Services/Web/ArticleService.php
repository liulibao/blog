<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/2/23
 * Time: 18:56
 */

namespace App\Services\Web;


use App\Models\Article;

class ArticleService
{
    protected $article_last_cache_key;

    protected $model;

    protected $cache_time = 3600 * 24 * 30;

    public function __construct()
    {
        $this->model = new Article();
    }

    /**
     * 获取最新或者推荐的文章
     * @param bool $is_recommend
     * @return mixed
     */
    public function getWebLastList($is_recommend = false)
    {
        $this->article_last_cache_key = 'article_last_cache_key_'.$is_recommend;

        $map = array(
            'deleted_at' => 0
        );

        if($is_recommend) {
            $map['is_recommend'] = Article::IS_RECOMMEND;
        }

        $data = getCache($this->article_last_cache_key);

        if($data === null) {
            $data = $this->model->where($map)
                ->select('id', 'title')
                ->limit(5)
                ->orderBy('id', 'desc')
                ->get();

            if($data) {
                $data = $data->toArray();
                setCache($this->article_last_cache_key, $data, $this->cache_time);
            }
        }

        return $data;
    }

}