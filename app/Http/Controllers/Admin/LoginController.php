<?php
/**
 * Created by PhpStorm.
 * User: hf-li
 * Date: 2019/1/11
 * Time: 20:32
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Request\LoginRequest;
use App\Repositories\User\AdminRepository;
use App\Traits\ApiResponse;

class LoginController extends Controller
{

    /**
     * @var
     */
    protected  $repository;


    public function __construct(AdminRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.login');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try{
            $status = $this->repository->checkLogin($request->username, $request->password, $request->is_remember);
            if($status) {
                $url = url('home');
                return ApiResponse::success(['url' => $url]);
            } else {
                throw new \Exception('登陆失败');
            }

        } catch (\Exception $exception) {
            return ApiResponse::error($exception->getMessage());
        }
    }
}