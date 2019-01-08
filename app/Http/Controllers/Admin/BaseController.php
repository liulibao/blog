<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2018/12/6
 * Time: 21:55
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Repositories\System\MenuRepository;
use App\Repositories\System\RoleRepository;

class BaseController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var
     */
    protected $menuRepository;

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

    public function __construct(RoleRepository $roleRepository, MenuRepository $menuRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->menuRepository = $menuRepository;
        $this->getUserHasPermission();
//        $this->getUserHasMenu();
        $this->uid = 1;
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
    public function getUserHasPermission()
    {
        $data = $this->roleRepository->getUserRolePermission($this->uid)->toArray();
        var_dump($data);
//        if($data){
//            $this->menu_ids = json_decode($data['menu_id'], true);
//        }
    }

    /**
     * 获取menu列表
     */
    public function getUserHasMenu()
    {
        var_dump($this->menu_ids);
        if($this->menu_ids) {
            foreach ($this->menu_ids as $item){
                $map = array(
                    'is_show' => 1,
                    'deleted_at' => 0,
                    'id' => $item
                );
                $this->menus[] = $this->menuRepository->where($map)->first();
            }
        }

    }
}