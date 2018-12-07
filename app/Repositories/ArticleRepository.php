<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/11/12
 * Time: 13:51
 */

namespace App\Repositories\Eloquent;


use App\Models\Articles;

class ArticleRepository extends BaseRepository
{

    public function model()
    {
        return Articles::class;
    }

    public function findAll()
    {
        return $this->model->paginate(1);
    }
}