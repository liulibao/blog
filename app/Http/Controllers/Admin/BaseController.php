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
use App\Traits\ApiResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
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
    public $menu_ids = [];

    /**
     * @var array
     */
    public $menus = [];

    /**
     * @var array
     */
    protected $hasPermission = [];

    protected $role_id;


    public function __construct()
    {
        //检测登陆
        $this->user = Session::get('user');
        $this->uid = $this->user['id'];
//        $this->getUserHasMenu();
//        view()->share('userHasMenu', $this->menus);
//        view()->share('request_prefix', getCurrentUrl());
    }

    /**
     * 获取用户拥有的menu列表
     */
    protected function getUserHasMenu()
    {
        if($this->menu_ids) {
            $map = array(
                'is_show' => Menu::IS_SHOW
            );

            $data = (new Menu())->getMenu($map, $this->menu_ids)->toArray();
            $datas = format_data_tree($data);

            if ($datas) {
                $this->menus = $datas;
            }
        }
    }
}