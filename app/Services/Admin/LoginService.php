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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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
        $this->isHasPermission();
    }

    /**
     * 是否拥有权限
     * @internal param Request $request
     */
    public function isHasPermission()
    {
        $this->getUserAllMenu();
        $this->getUserHasPermission();
        $currentUrl = getCurrentUrl();
        $path = array_column($this->hasPermission, 'path' , 'id');
        sort($path);

        if(!in_array($currentUrl, $path)) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * 获取角色权限ID
     */
    protected function getUserHasPermission()
    {
        $menu_ids = (new RolePermission())->where('role_id', $this->role_id)->value('menu_id');

        if($menu_ids){
            $this->menu_ids = explode(',', $menu_ids);
        }

    }

    /**
     * 获取用户拥有的menu列表
     */
    public function getUserHasMenu()
    {
        $menu = array();

        if($this->menu_ids) {
            $map = array(
                'is_show' => Menu::IS_SHOW
            );

            $data = (new Menu())->getMenu($map, $this->menu_ids)->toArray();
            return format_data_tree($data);
        }

        return $menu;
    }

    /**
     * 获取用户所有权限
     */
    protected function getUserAllMenu()
    {
        if($this->menu_ids) {
            $this->hasPermission = (new Menu())->getMenu([], $this->menu_ids)->toArray();
        }
    }
}