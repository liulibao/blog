<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/27
 * Time: 11:11
 */

namespace App\Repositories\Advert;


use App\Models\Advert;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class AdvertRepository extends BaseRepository
{

    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return Advert::class;
    }

    /**
     * 获取广告分类
     * @return mixed
     */
    public function getTypes()
    {
        return $this->model->types();
    }

    /**
     * 获取列表
     * @param Request $request
     * @return mixed
     */
    public function getLists(Request $request)
    {
        $result = $this->model;

        if(!empty($request->title)){
            $result = $result->where('title', 'like', '%'.$request->title.'%');
        }

        if(!empty($request->type_id)){
            $result = $result->where('type_id', $request->type_id );
        }

        return $result = $result->where('deleted_at', '0')
            ->with('attachment')
            ->orderBy('id', 'desc')
            ->paginate();
    }

    /**
     * 获取广告/幻灯片图片
     * @param $type_id 【图片类型】 1-幻灯片
     * @return array
     */
    public function getWebLists($type_id = 1)
    {

        $result = $this->model->where('adverts.deleted_at', '0')
            ->where('adverts.type_id', $type_id)
            ->select('adverts.id','adverts.title','adverts.path as jump_url','adverts.attachment_id', 'attachments.path')
            ->leftJoin('attachments', 'attachments.id', '=', 'adverts.attachment_id')
            ->orderBy('adverts.id', 'desc')
            ->get();

        if($result) {
            $result = $result->toArray();
            foreach ($result as $k => &$item) {
                $result[$k]['path'] = asset($item['path']);
                unset($item);
            }
            return $result;
        }

        return [];
    }
}