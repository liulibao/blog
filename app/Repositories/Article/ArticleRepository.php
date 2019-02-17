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
use Illuminate\Support\Facades\Cache;

class ArticleRepository extends BaseRepository
{
    protected $article_cache_key;

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

        return $result->orderBy('deleted_at', 'asc')
            ->orderBy('id', 'desc')
            ->paginate();
    }

    public function getWebLists(Request $request)
    {
        return $this->model->where('deleted_at', 0)
            ->select('id', 'title', 'image', 'read_num', 'comment_num', 'type_id', 'contents', 'created_at', 'deleted_at')
            ->orderBy('id', 'desc')
            ->paginate()
            ->toArray();

    }

    /**
     * @param $article_id
     * @return mixed
     */
    public function getArticleDetail($article_id)
    {
        $this->article_cache_key = 'article_cache_key_'.$article_id;

        $data = getCache($this->article_cache_key);

        $map = array(
            'deleted_at' => 0,
            'id' => $article_id
        );

        if($data === null) {
            $data = $this->model->where($map)
                ->select('id', 'title', 'image', 'read_num', 'comment_num', 'type_id', 'contents', 'created_at', 'deleted_at')
//                ->leftJoin('')
                ->first();

            if($data) {
                $data = $data->toArray();
                setCache($this->article_cache_key, $data, 3600*24*30);
            }
        }

        return $data;
    }
}