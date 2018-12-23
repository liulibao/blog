<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/11/14
 * Time: 22:40
 */

namespace App\Repositories\Article;


use App\Models\ArticleCategory;
use App\Repositories\BaseRepository;

class ArticleCategoryRepository extends BaseRepository
{
    public function model()
    {
        return ArticleCategory::class;
    }

    /**
     * 多条插入
     * @param $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    /**
     * 获取列表
     * @return mixed
     */
    public function getLists()
    {
        return $this->model->where('deleted_at', 0)
            ->orderBy('id','desc')
            ->paginate();
    }

    /**
     * 获取分类的ID和标题
     * @return mixed
     */
    public function getAll()
    {
        return $this->model->where('deleted_at', 0)
            ->select('id', 'name')
            ->get();
    }

}