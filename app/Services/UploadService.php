<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/29
 * Time: 13:11
 */

namespace App\Services;


use App\Repositories\AttachmentRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UploadService
{
    /**
     * @var AttachmentRepository
     */
    protected $repository;

    public function __construct(AttachmentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 上传文件
     * @param Request $request
     * @return bool
     * @throws \Exception
     */
    public function upload( Request $request, $path = 'uploads')
    {
        try {

            if (!$request->isMethod('post')) {
                throw new \Exception('请求方式不正确，请用POST');
            }

            if(!$request->hasFile('files')){
                throw new \Exception('请上传文件');
            }

            $file = $request->file('files');

            // 文件是否上传成功
            if (!$file->isValid()) {
                throw new \Exception('文件上传失败，请重新上传');
            }

            // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension(); // 扩展名
            $realPath = $file->getRealPath(); // 临时文件的绝对路径
            $type = $file->getClientMimeType(); // image/jpeg
            $size = $this->getFileSize( $file->getsize()); //文件大小

            // 上传文件
            $savePath = date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d'); // 文件路由
            $filename = uniqid(date('H-i-s-'), 16) . FILE_SPOT . $ext; // 文件名
            $completePath = $savePath . DIRECTORY_SEPARATOR . $filename; // 文件完整路由

            $bool = Storage::disk($path)->put($completePath, file_get_contents($realPath));

            if (!$bool) {
                throw new \Exception('文件生成失败');
            }

            $data = array(
                'original' => $originalName,
                'filename' => $filename,
                'mime_type' => $type,
                'path' => $path . DIRECTORY_SEPARATOR . $completePath,
                'size' => $size,
                'ext' => $ext,
            );

            return  $this->repository->create($data);
        } catch ( \Exception $exception ) {
            throw new \Exception($exception->getMessage());
        }
    }

    /**
     * 删除文件
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function deleteFile(Request $request)
    {
        try{
            if(intval($request->file_id) <= 0 ){
                throw new \Exception('请求参数有误');
            }

            return $this->repository->delete($request->file_id);

        } catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }


    /**
     * 获取文件文件大小
     * @param $fileSize
     * @return string
     */
    public function getFileSize($fileSize)
    {
        switch ($fileSize){
            case $fileSize >= 1073741824:
                $fileSize = round($fileSize / 1073741824 * 100) / 100 . ' GB';
                break;
            case $fileSize >= 1048576:
                $fileSize = round($fileSize / 1048576 * 100) / 100 . ' MB';
                break;
            case $fileSize >= 1024:
                $fileSize = round($fileSize / 1024 * 100) / 100 . ' KB';
                break;
            default:
                $fileSize = $fileSize . ' 字节';
                break;
        }

        return $fileSize;
    }
}