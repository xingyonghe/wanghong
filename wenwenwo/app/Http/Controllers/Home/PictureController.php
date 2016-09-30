<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/9/14
 * Time: 9:59
 * Author: dch
 */

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Constraint;
use Storage;
use stdClass;
use Response;

/**
 * 用户上传图片(包含业务规则)
 *
 * Class PictureController
 * @package App\Http\Controllers\Home
 */
class PictureController extends Controller
{
    protected $allowExtensions = ["jpg", "jpeg", "png", "bmp"];//允许的类型

    /**
     * 生成图片
     *
     * @param $picPath
     * @param $newWidth
     * @param $newHeight
     * @return bool|mixed
     */
    protected function buildPicture($picPath, $newWidth, $newHeight)
    {
        if (!file_exists($picPath)) {
            return false;
        }
        $newPath = preg_replace('~(\.\w+)$~Uis', "_{$newWidth}x{$newHeight}$1", $picPath);
        // 通过指定 driver 来创建一个 image manager 实例
        $manager = new ImageManager(array('driver' => 'gd'));
        // 最后创建 image 实例
        $oldImage = $manager->make($picPath);

        if ($oldImage->getHeight() > $oldImage->getWidth()) {
            $resWidth = NULL;
            $resHeight = max($newWidth, $newHeight);
        } else {
            $resWidth = max($newWidth, $newHeight);
            $resHeight = NULL;
        }

        $oldImage->resize($resWidth, $resHeight, function (Constraint $constraint) {
            $constraint->aspectRatio();
        });
        $newImage = $manager->canvas($newWidth, $newWidth, '#ffffff');
        $newImage->insert($oldImage, 'center');
        $newImage->save($newPath);

        $oldImage->destroy();
        $newImage->destroy();
        return $newPath;

    }

    public function demo()
    {
        return view('home.picture.demo');
    }

    //附件上传
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

    //处理文件
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
