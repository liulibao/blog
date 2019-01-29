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
use App\Services\Admin\LoginService;
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


    public function __construct()
    {

    }

    public function getUser()
    {
        return collect(session('user'))->toArray();
    }
}