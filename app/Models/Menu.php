<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/2
 * Time: 21:52
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    const IS_SHOW = 1;

    protected $fillable = ['name', 'pid', 'path', 'depth', 'icon', 'is_show', 'sort', 'remarks'];

    /**
     * 获取目录
     * @param array $condition
     * @param array $condition_in
     * @return mixed
     */
    public function getMenu($condition = [], $condition_in = [])
    {
        $map = array(
            'deleted_at' => 0,
        );

        if(!empty($condition)) {
            $map = array_merge($map, $condition);
        }

        $model = $this->where($map);

        if(!empty($condition_in)) {
            $model =  $model->whereIn('id', $condition_in);
        }

        return $model->select('id', 'name', 'path', 'icon', 'pid')
            ->orderBy('sort', 'ASC')
            ->get();
    }
}