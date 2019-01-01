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
use Illuminate\Http\Request;

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
    public function getTypes()
    {
        return $this->model->types();
    }

    /**
     * 文章列表
     * @return mixed
     */
    public function getLists(Request $request)
    {
        $result = $this->model;
        if(!empty($request->title)){
            $result = $result->where('title','like','%'.$request->title.'%');
        }

        if(!empty($request->category_id)){
            $result = $result->where('category_id', $request->category_id);
        }

        return $result ->orderBy('deleted_at', 'asc')
            ->orderBy('id', 'desc')
            ->paginate();
    }
}