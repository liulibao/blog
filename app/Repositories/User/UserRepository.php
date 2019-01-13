<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/25
 * Time: 21:53
 */

namespace App\Repositories\User;


use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository
{

    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return User::class;
    }

    /**
     * 获取列表
     * @param Request $request
     * @param bool $is_admin 是否是管理员
     * @return
     */
    public function getLists(Request $request)
    {
        $result = $this->model->where('deleted_at', 0)
            ->where('is_admin', User::IS_USER);

        if(!empty($request->name)){
            $result = $result->where('name', 'like' ,'%'.trim($request->name).'%');
        }

        return $result->orderBy('id', 'desc')
            ->paginate();
    }
}