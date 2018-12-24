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
    public function getTags()
    {
        return $this->model->tags();
    }

    /**
     * 文章列表
     * @return mixed
     */
    public function getLists(Request $request)
    {
        $result = $this->model->where('deleted_at', 0);
        if(!empty($request->title)){
            $result->where('title','like','%'.$request->title.'%');
        }

        if(!empty($request->category_id)){
           $result->where('category_id', $request->category_id);
        }

        return $result->orderBy('id', 'desc')
            ->paginate();
    }
}