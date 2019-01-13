<?php

namespace App\Repositories\User;
use App\Models\Admin;
use App\Repositories\BaseRepository;
use App\Repositories\System\RolePermissionRepository;
use App\Repositories\System\UserRoleRepository;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/11
 * Time: 20:49
 */

class AdminRepository extends BaseRepository
{
    protected $rolePermissionRepository;

    public function __construct(
        Application $app,
        RolePermissionRepository $rolePermissionRepository
    )
    {
        parent::__construct($app);
        $this->rolePermissionRepository = $rolePermissionRepository;
    }

    /**
     * 定义model 类名
     * @return mixed
     */
    public function model()
    {
        return Admin::class;
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
            ->where('is_admin', Admin::IS_ADMIN);

        if(!empty($request->name)){
            $result = $result->where('name', 'like' ,'%'.trim($request->name).'%');
        }

        return $result->orderBy('id', 'desc')
            ->paginate();
    }

    /**
     * 检查用户是否登陆
     * @param $username
     * @param $password
     */
    public function checkLogin($username, $password, $is_remember = 0)
    {
        $wheres = array(
            'username' => $username,
            'is_admin' => Admin::IS_ADMIN
        );

        $user = $this->model->where($wheres)->first();

        if(!$user) {

            throw new \Exception('用户名不存在');
        }

        if (!Hash::check($password, $user->password)) {

            throw new \Exception('用户密码错误');
        }

        if ($is_remember == '1') {
            Cookie::queue('username', $username, 10); // 10 分钟
            Cookie::queue('password', $password, 10);
            Cookie::queue('remember_me', $is_remember, 10);
        } else {
            Cookie::queue('username', $username, -1); // 清楚
            Cookie::queue('password', $password, -1);
            Cookie::queue('remember_me', $is_remember, -1);
        }

        $role_id =  $this->rolePermissionRepository->getPermissionByRoleId($user->id);

        Session::put('user', $user);
        Session::put('userRole', $role_id);
        Session::put('_isLogin_','1');
        Session::put('_loginTime_',time());

        return $user;
    }
}