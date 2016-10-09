<?php
namespace App\Library;

use DB;

class LocalUpload{

    private $config = array();//默认上传配置
    private $error = '';      //上传错误信息
    private $uploader;        //上传驱动实例
    private $rootpath = '';   //上传根目录
    private $table = '';      //上传关系数据表

    /**
     * 自动设置，用于构造上传实例
     * @param array  $config 配置
     */
    public function __construct($config = array()){
        // 获取配置
        $this->config = $config;

        // 设置上传驱动
        $this->uploader = $this->config['uploader'];
        $this->table = $this->config['table'];

        // 调整配置，把字符串配置参数转换为数组
        if(!empty($this->config['mimes'])){
            if(is_string($this->config['mimes'])) {
                $this->config['mimes'] = explode(',', $this->config['mimes']);
            }
            $this->config['mimes'] = array_map('strtolower', $this->config['mimes']);
        }
        if(!empty($this->config['exts'])){
            if (is_string($this->config['exts'])){
                $this->config['exts'] = explode(',', $this->config['exts']);
            }
            $this->config['exts'] = array_map('strtolower', $this->config['exts']);
        }
    }

    /**
     * 获取最后一次上传错误信息
     * @return string 错误信息
     */
    public function getError(){
        return $this->error;
    }

    /**
     * 上传文件
     * @param 文件信息数组 $files ，通常是 $_FILES数组
     * @param 上传配置 $config ，位于filesystems.php中的'disks'
     */
    public function uploads($files){
        if('' === $files){
            $files = $_FILES;
        }
        if(empty($files)){
            $this->error = '没有上传的文件！';
            return false;
        }

        //检测根目录
        if(!(is_dir($this->config['root']) && is_writable($this->config['root']))){
            $this->error = '上传根目录不存在！请尝试手动创建:'.$this->config['root'];
            return false;
        }
        $this->rootPath = $this->config['root'].'/';

        // 记录上传文件信息
        $info = array();

        foreach ($files as $key => $file) {
            //判断系统文件设置错误
            if($file->getError()){
                $this->error = $file->getErrorMessage();
                return false;
            }
            $info['tmp_name'] = $file->getPathname();//缓存temp名称
            $info['name'] = $file->getClientOriginalName();// 文件原名
            $info['ext'] = $file->getClientOriginalExtension();     // 扩展名
            $info['size'] = $file->getClientSize();//文件大小
            $info['type'] = $file->getClientMimeType();//文件大小

            // 文件上传检测
            // 无效上传
            if (empty($info['name'])){
                $this->error = '未知上传错误！';
                return false;
            }

            //判断文件是否上传成功
            if (!$file->isValid()) {
                $this->error = "上传失败";
                return false;
            }

            // 检查文件大小
            if (!$this->checkSize($info['size'])) {
                $this->error = '上传文件大小不符！';
                return false;
            }

            // 检查文件Mime类型
            if (!$this->checkMime($info['type'])) {
                $this->error = '上传文件MIME类型不允许！';
                return false;
            }

            // 检查文件后缀
            if (!$this->checkExt($info['ext'])) {
                $this->error = '上传文件后缀不允许';
                return false;
            }

            // 获取文件hash
            if($this->config['hash']){
                $info['md5']  = md5_file($info['tmp_name']);
                $info['sha1'] = sha1_file($info['tmp_name']);
            }

            // 检测文件是否存在
            // 查找文件
            $map = array('md5' => $info['md5'],'sha1'=>$info['sha1']);
            $pic_data = DB::table($this->table)->where($map)->first();
            if($pic_data){

                $exists = file_exists('.'.$pic_data->path);
                //判断路径存不存在，如存在则返回
                if ( file_exists('.'.$pic_data->path)) {
                    foreach ($pic_data as $k=>$val){
                        $info[$k] = $val;
                    }
                    $fileinfo[$key] = $info;
                    continue;
                }else {
                    //如果不存在，删除垃圾数据
                    DB::table($this->table)->where(array('id'=>$pic_data->id))->delete();
                }
            }
            // 检测并创建子目录
            $subpath = $this->getSubPath($info['name']);
            if(false === $subpath){
                continue;
            } else {
                $info['savepath'] = $subpath;
            }

            /* 生成保存文件名 */
            $savename = $this->getSaveName($info);
            if(false == $savename){
                continue;
            } else {
                $info['savename'] = $savename;
            }

            /* 对图像文件进行严格检测 */
            $ext = strtolower($info['ext']);
            if(in_array($ext, array('gif','jpg','jpeg','bmp','png','swf'))) {
                $imginfo = getimagesize($info['tmp_name']);
                if(empty($imginfo) || ($ext == 'gif' && empty($imginfo['bits']))){
                    $this->error = '非法图像文件！';
                    continue;
                }
            }
            $filename = $info['savepath'] . $info['savename'];
            $info['error'] = $this->error;
            /* 保存文件 并记录保存成功的文件 */
            if ($this->uploader->put($filename,file_get_contents($info['tmp_name']))) {
                unset($info['error'], $info['tmp_name']);
                $info['rootpath'] = $this->rootPath;
                $fileinfo[$key] = $info;
            } else {
                $this->error = '上传失败';
                return false;
            }
        }

        return empty($fileinfo) ? false : $fileinfo;
    }


    /**
     * 检查文件大小是否合法
     * @param integer $size 数据
     */
    private function checkSize($size) {
        return !($size > $this->config['maxsize']) || (0 == $this->config['maxsize']);
    }

    /**
     * 检查上传的文件MIME类型是否合法
     * @param string $mime 数据
     */
    private function checkMime($mime) {
        return empty($this->config['mimes']) ? true : in_array(strtolower($mime), $this->config['mimes']);
    }

    /**
     * 检查上传的文件后缀是否合法
     * @param string $ext 后缀
     */
    private function checkExt($ext) {
        return empty($this->config['exts']) ? true : in_array(strtolower($ext), $this->config['exts']);
    }

    /**
     * 根据上传文件命名规则取得保存文件名
     * @param string $file 文件信息
     */
    private function getSaveName($file) {
        $rule = $this->config['savename'];
        if (empty($rule)) { //保持文件名不变
            //解决pathinfo中文文件名BUG
            $filename = substr(pathinfo("_{$file['name']}", PATHINFO_FILENAME), 1);
            $savename = $filename;
        } else {
            $savename = $this->getName($rule, $file['name']);
            if(empty($savename)){
                $this->error = '文件命名规则错误！';
                return false;
            }
        }
        return $savename . '.' . $file['ext'];
    }



    /**
     * 获取子目录的名称
     * @param array $file  上传的文件信息
     */
    private function getSubPath($filename) {
        $subpath = '';
        $rule    = $this->config['subname'];
        if (!empty($rule)) {
            $subpath = $this->getName($rule, $filename) . '/';
            if(!empty($subpath) && !$this->mkdir($subpath)){
                return false;
            }
        }
        return $subpath;
    }

    /**
     * 根据指定的规则获取文件或目录名称
     * @param  array  $rule     规则
     * @param  string $filename 原文件名
     * @return string           文件或目录名称
     */
    private function getName($rule, $filename){
        $name = '';
        if(is_array($rule)){ //数组规则
            $func     = $rule[0];
            $param    = (array)$rule[1];
            foreach ($param as &$value) {
                $value = str_replace('__FILE__', $filename, $value);
            }
            $name = call_user_func_array($func, $param);
        } elseif (is_string($rule)){ //字符串规则
            if(function_exists($rule)){
                $name = call_user_func($rule);
            } else {
                $name = $rule;
            }
        }
        return $name;
    }

    /**
     * 创建目录
     * @param  string $savepath 要创建的穆里
     * @return boolean          创建状态，true-成功，false-失败
     */
    private function mkdir($savepath){
        $dir = $this->rootPath . $savepath;
        if(is_dir($dir)){
            return true;
        }
        if(mkdir($dir, 0777, true)){
            return true;
        } else {
            $this->error = "目录 {$savepath} 创建失败！";
            return false;
        }
    }

}