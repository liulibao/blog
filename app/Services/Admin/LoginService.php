<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/21
 * Time: 22:43
 */

namespace App\Services\Admin;


use App\Models\Menu;
use App\Models\RolePermission;
use Illuminate\Contracts\Session\Session;

class LoginService
{
    /**
     * @var
     */
    public $uid;

    /**
     * @var array
     */
    public $user = [];

    /**
     * @var array
     */
    public $menu_ids = [];

    /**
     * @var array
     */
    public $menus = [];

    /**
     * @var array
     */
    protected $hasPermission = [];

    public function __construct()
    {
        //检测登陆
        $this->user = Session::get('user');
        $this->uid = $this->user['id'];
        $this->role_id = 1;
        $this->getUserHasPermission();
        $this->getUserHasMenu();
        $this->isHasPermission();
        view()->share('userHasMenu', $this->menus);
        view()->share('request_prefix', format_url(getCurrentUrl())[1]);
    }

    /**
     * 是否拥有权限
     * @internal param Request $request
     */
    protected function isHasPermission()
    {
        $path = array_column($this->hasPermission, 'path' , 'id');
//        var_dump($path);
//        echo getCurrentUrl();
    }


    /**
     * 获取角色权限ID
     */
    protected function getUserHasPermission()
    {
        $menu_ids = (new RolePermission())->where('role_id', 1)->value('menu_id');

        if($menu_ids){
            $this->menu_ids = explode(',', $menu_ids);
        }

    }


    /**
     * 获取用户拥有的menu列表
     */
    protected function getUserHasMenu()
    {
        if($this->menu_ids) {
            $map = array(
                'is_show' => Menu::IS_SHOW,
            );

            $data = (new Menu())->where($map)
                ->whereIn('id', $this->menu_ids)
                ->select('id', 'name', 'path', 'icon', 'pid')
                ->orderBy('sort', 'ASC')
                ->get()
                ->toArray();

            $this->hasPermission = $data;
            $data = format_data_tree($data);

            if ($data) {
                $this->menus = $data;
            }
        }
    }
}