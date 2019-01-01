<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/26
 * Time: 19:03
 */

namespace App\Http\Controllers\Admin\Advert;


use App\Http\Controllers\Admin\BaseController;
use App\Http\Request\AdvertRequest;
use App\Repositories\Advert\AdvertRepository;
use App\Services\UploadService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdvertController extends BaseController
{
    /**
     * @var AdvertRepository
     */
    protected $repository;

    /**
     * @var int
     */
    protected $admin_id;

    /**
     * @var UploadService
     */
    protected $uploadService;

    /**
     * AdvertController constructor.
     */
    public function __construct(AdvertRepository $repository, UploadService $service)
    {
        $this->repository = $repository;
        $this->uploadService = $service;
        $this->admin_id = 1;
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
        foreach ( $lists as &$item){
            if($item->attachment !== null) {
                $item->attachment->path = url($item->attachment->path);
            }
            unset($item);
        }

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
                $lists = $this->repository->with(['attachment'])->find($request->id);
                if( $lists->attachment !== null ){
                    $lists->attachment->path = url($lists->attachment->path);
                }
            }

            $types = $this->repository->getTypes();
            return view('admin.advert.edit', compact('page_title', 'lists' , 'types'));
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
            $result = $this->uploadService->upload($request);
            return ApiResponse::success($result);
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }

    /**
     * 删除文件
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFile(Request $request)
    {
        try{
            DB::beginTransaction();
            $this->uploadService->deleteFile($request);
            $this->repository->update(['attachment_id' => 0], ['attachment_id' => $request->file_id]);
            DB::commit();
            return ApiResponse::success();
        } catch ( \Exception $exception){
            DB::rollBack();
            return ApiResponse::error($exception->getMessage());
        }
    }

    /**
     * 保存数据
     * @param AdvertRequest $request
     * @return mixed
     */
    public function store(AdvertRequest $request)
    {
        try{
            if(empty($request->id)){

                $request['uid'] = $this->admin_id;
                $this->repository->create( array_filter($request->all()));
            } else {

                if(intval($request->id) <= 0){
                    throw new \Exception('请求参数错误');
                }

                $this->repository->update( array_filter($request->all()), $request->id);
            }

            return ApiResponse::success();
        } catch (\Exception $exception){
            return ApiResponse::error($exception->getMessage());
        }
    }

    /**
     * 删除操作
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
       try{
           if ($request->id && intval($request->id) < 0 ) {
               throw new \Exception('请求参数错误');
           }

           $this->repository->delete($request->id, true);
           return ApiResponse::success();
       } catch (\Exception $exception) {
           return ApiResponse::error($exception->getMessage());
       }
    }
}