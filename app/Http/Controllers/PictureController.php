<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Constraint;
use Storage;
use App\Models\Picture;
use Response;

class PictureController extends Controller{

    public function upload(Request $request){
        /* 返回标准数据 */
        $return  = array('status' => 1, 'info' => '上传成功');
        $files = $request->file();
        $config = config('filesystems.disks.picture');
        $info = Picture::upload($files,$config);
        /* 记录图片信息 */
        return Response::json($info);
    }
}
