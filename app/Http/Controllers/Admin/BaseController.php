<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/6
 * Time: 21:55
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\RolePermission;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller
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
    protected $role_ids = [];

    /**
     * @var array
     */
    public $menu_ids = [];

    /**
     * @var array
     */
    public $menus = [];


    public function __construct()
    {
        //检测登陆
        $this->user = Session::get('user');
        $this->uid = $this->user['id'];
        $this->role_id = 1;
        $this->getUserHasPermission();
        $this->getUserHasMenu();
    }


    //获取IP
    public function getIP()
    {
        $request = request();
        $ip = ip2long($request->getClientIp());
        return  bindec(decbin($ip));
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
    public function getUserHasMenu()
    {
        if($this->menu_ids) {
            $map = array(
                'is_show' => 1,
            );
            $data = (new Menu())->where($map)
                ->whereIn('id', $this->menu_ids)
                ->select('id', 'name', 'path', 'icon', 'pid')
                ->orderBy('sort', 'ASC')
                ->get()
                ->toArray();

            if ($data) {
                $this->menus[] = $data;
            }
        }
    }
}