<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/2
 * Time: 21:55
 */

namespace App\Repositories\System;


use App\Models\Menu;
use App\Repositories\BaseRepository;

class MenuRepository extends BaseRepository
{

    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return Menu::class;
    }

    /**
     * 保存
     * @param $data
     * @return mixed
     */
    public function creates(array $data)
    {
        if($data['pid'] > 0){
            $depth = $this->getDepthById($data['pid']);
            $data['depth'] = $depth + 1;
        }

        return parent::create(array_filter($data));
    }

    /**
     * 更新
     * @param array $data
     * @param $condition
     * @return mixed
     */
    public function updates(array $data, $condition)
    {
        if($data['pid'] > 0){
            $depth = $this->getDepthById($data['pid']);
            $data['depth'] = $depth + 1;
        }

        return parent::update(array_filter($data), $condition);
    }

    /**
     * 首页列表
     */
    public function getLists()
    {
        return $this->model->where('deleted_at', 0)
            ->orderBy('sort', 'asc')
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * 获取目录
     * @param array $map
     * @return
     */
    public function getMenu(array $map = array())
    {
        $model = $this->model->where('deleted_at', 0);
        if(!empty($map)) {
           $model = $model->where($map);
        }

        return $model->select('id','name', 'pid')
            ->orderBy('sort', 'asc')
            ->get();
    }

    /**
     * 通过ID获取目录深度
     * @param $id
     * @return mixed
     */
    public function getDepthById(int $id)
    {
        return $this->model->where('deleted_at', 0)
            ->where('id', $id)
            ->value('depth');
    }
}