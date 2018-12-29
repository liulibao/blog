<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/26
 * Time: 19:03
 */

namespace App\Http\Controllers\Admin\Advert;


use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Admin\MethodInterface;
use App\Repositories\Advert\AdvertRepository;
use App\Traits\ApiResponse;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdvertController extends BaseController implements MethodInterface
{
    protected $repository;

    /**
     * AdvertController constructor.
     */
    public function __construct(AdvertRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 列表首页
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $page_title = '广告列表';
        $lists = $this->repository->getLists($request);
        $types = $this->repository->getTypes();
        return view('admin.advert.index', compact('page_title', 'lists', 'types'));
    }

    /**
     * 编辑页面
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request)
    {
        try{
            if(empty($request->id)){
                $page_title = '添加广告';
            } else {
                if(intval($request->id) <= 0){
                    throw new \Exception('请求参数错误');
                }
                $page_title = '编辑广告';
                $lists = $this->repository->find($request->id);
            }

            $types = $this->repository->getTypes();
            return view('admin.advert.edit', compact('page_title', 'types', 'lists'));
        } catch (\Exception $exception){
            return redirect('admin/error')->with('error', $exception->getMessage());
        }
    }

    /**
     * 下载文件
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(Request $request)
    {
        try{
            $result = UploadTrait::upload($request);
            return ApiResponse::success($result);
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }

    /**
     * 保存数据
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    /**
     * 删除操作
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        // TODO: Implement delete() method.
    }
}