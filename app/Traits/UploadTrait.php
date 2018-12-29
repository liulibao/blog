<?php
/**
 * Created by PhpStorm.
 * User: Raytine
 * Date: 2018/12/29
 * Time: 13:11
 */

namespace App\Traits;


use App\Models\Attachment;
use App\Repositories\AttachmentRepository;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UploadTrait extends UploadedFile
{
    /**
     * 上传文件
     * @param Request $request
     * @return bool
     * @throws \Exception
     */
    public static function upload(Request $request, $path = 'uploads')
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
            $realPath = $file->getRealPath(); //临时文件的绝对路径
            $type = $file->getClientMimeType(); // image/jpeg

            // 上传文件
            $savePath = date('Y') . DIRECTORY_SEPARATOR . date('m') . DIRECTORY_SEPARATOR . date('d');
            $filename = uniqid(date('H-i-s-'), 16) . '.' . $ext;
            $bool = Storage::disk($path)->put($savePath.DIRECTORY_SEPARATOR.$filename, file_get_contents($realPath));

            if (!$bool) {
                throw new \Exception('文件生成失败');
            }

            $data = array(
                'original' => $originalName,
                'filename' => $filename,
                'mime_type' => $type,
                'path' => $path. '/' . $filename,
                'ext' => $ext,
            );

            return Attachment::create($data);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
}