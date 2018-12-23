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

class ArticleRepository extends BaseRepository
{

    public function model()
    {
        return Article::class;
    }

    /**
     * 获取文章tag
     * @return mixed
     */
    public function getTags()
    {
        return $this->model->tags();
    }

    /**
     * 文章列表
     * @return mixed
     */
    public function getLists()
    {
        return $this->model->where('deleted_at', 0)
            ->orderBy('id', 'desc')
            ->paginate();
    }
}