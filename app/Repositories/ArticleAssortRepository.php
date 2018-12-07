<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/11/14
 * Time: 22:40
 */

namespace App\Repositories\Eloquent;


use App\Models\ArticleAssort;

class ArticleAssortRepository extends BaseRepositoryEloquent
{
    public function model()
    {
        return ArticleAssort::class;
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
        return $this->model->orderBy('id','desc')->paginate();
    }

}