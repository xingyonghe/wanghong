<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Storage;
use stdClass;
use Response;

//use App\Libraries\Picture\PictureManager;

/**
 * 只用于后台的文件上传
 *
 * Class UploadController
 * @package App\Http\Controllers\Admin
 * @author dch
 */
class UploadController extends Controller
{
    //允许的后缀
    protected $allowExtensions = ["zip", "rar", "tar", "pdf", "jpg", "jpeg", "png", "bmp", "doc", "excel"];

    //演示
    public function demo()
    {
        //$pm = new PictureManager();
        //$path = $pm->buildPicture(public_path('uploads/20160914/09434357d8ab4f83415.png'), 30, 40);
        //dd($path);

        return view('admin.upload.demo');
    }

    // 附件上传
    public function upload(Request $request)
    {
        $ret = new stdClass();
        $allFiles = $request->allFiles();
        foreach ($allFiles as $fileName => $files) {
            if (!is_array($files)) {
                $files = [$files];
            }
            $ret->{$fileName} = $this->doFiles($files);
        }

        //HTTP_USER_AGENT 兼容IE系列
        if (strpos($_SERVER['HTTP_USER_AGENT'] ?? "", 'MSIE')) {
            return Response::json($ret, 200, ['Content-Type' => 'text/plain']);
        }

        return Response::json($ret);
    }

    // 处理文件
    protected function doFiles(array $files)
    {
        $retFiles = [];
        foreach ($files as $file) {
            $retFile = new stdClass();
            $retFiles[] = $retFile;
            $retFile->error = -1;
            if (!$file->isValid()) {
                $retFile->message = "上传失败";
                continue;
            }

            $originalName = $file->getClientOriginalName(); // 文件原名
            $ext = $file->getClientOriginalExtension();     // 扩展名
            $realPath = $file->getRealPath();               // 临时文件的绝对路径
            //$type = $file->getClientMimeType();             // image/jpeg

            if (!in_array($ext, $this->allowExtensions)) {
                $retFile->message = "文件格式不允许";
                continue;
            }

            $filename = date('Ymd') . DIRECTORY_SEPARATOR . date('His') . uniqid() . '.' . $ext;
            // 使用我们新建的uploads本地存储空间（目录）
            $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
            if (empty($bool)) {
                $retFile->message = "服务器忙,请稍后再试";
                continue;
            }

            $retFile->url = (str_replace('\\', '/', "/uploads/{$filename}"));
            $retFile->thumbnailUrl = (str_replace('\\', '/', "/uploads/{$filename}"));
            $retFile->name = $originalName;
            $retFile->size = $file->getSize();
            $retFile->error = 0;
        }

        return $retFiles;
    }

}
