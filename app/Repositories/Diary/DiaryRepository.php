<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/26
 * Time: 14:13
 */

namespace App\Repositories\Diary;


use App\Models\Dairy;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class DiaryRepository extends BaseRepository
{
    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return Dairy::class;
    }

    /**
     * 获取列表
     * @param Request $request
     */
    public function getLists(Request $request)
    {
        $result = $this->model;
        if(!empty($request->title)){
            $result = $result->where('title', 'like', '%'.$request->title.'%');
        }

        return $result->orderBy('id', 'desc')->paginate();
    }


}