<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;

class PictureController extends Controller{

    /**
     * 图片上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request){
        /* 返回标准数据 */
        $return  = array('status' => 1, 'info' => '上传成功');
        $files = $request->file();
        $config = config('filesystems.disks.picture');
        $info = Picture::upload($files,$config);
        /* 记录图片信息 */
        return response()->json($info);
    }

    /**
     * 头像上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatar(Request $request){
        /* 返回标准数据 */
        $return  = array('status' => 1, 'info' => '上传成功');
        $files = $request->file();
        $config = config('filesystems.disks.avatar');
        $info = Picture::avatar($files,$config);
        /* 记录图片信息 */
        return response()->json($info);
    }
}
