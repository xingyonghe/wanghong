<?php
namespace App\Library;

use Storage;

trait Upload{

    private $config = array();//默认上传配置
    private $error = ''; //上传错误信息
    private $uploader;//上传驱动实例
    private $rootpath = '';//上传根目录

    /**
     * 自动设置，用于构造上传实例
     * @param array  $config 配置
     */
    private function uploadInit($config = array()){
        // 获取配置
        $this->config = $config;
        // 设置上传驱动
        $this->setDriver($this->config);
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
    protected function getError(){
        return $this->error;
    }

    /**
     * 设置上传驱动
     * @param string $driver 驱动名称
     * @param array $config 驱动配置
     */
    private function setDriver($config = array()){
        $driver = $config['driver'];
        $driverConfig = $config['driver_config'];
        switch ($driver){
            case 'local':
                $this->uploader = Storage::disk('uploads');
                break;
        }
    }

    /**
     * 上传文件
     * @param 文件信息数组 $files ，通常是 $_FILES数组
     * @param 上传配置 $config ，位于filesystems.php中的'disks'
     */
    protected function uploads($files,$config){
        //自动设置
        $this->uploadInit($config);
        if('' === $files){
            $files = $_FILES;
        }
        if(empty($files)){
            $this->error = '没有上传的文件！';
            return false;
        }
        //检测根目录
        $this->checkRootPath($this->config['root']);

        //检测上传目录
        $this->checkSavePath($this->config['savepath']);

        // 记录上传文件信息
        $info = array();

        foreach ($files as $key => $file) {
            $info['name'] = $file->getClientOriginalName();// 文件原名
            $info['ext'] = $file->getClientOriginalExtension();     // 扩展名
            $info['size'] = $file->getClientSize();//文件大小
            $info['type'] = $file->getClientMimeType();//文件大小
            $info['tmp_name'] = $file->getPathname();

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

            // 调用回调函数检测文件是否存在
            $data = call_user_func($this->config['callback'], $info);
            if( $this->config['callback'] && $data ){
                if ( file_exists('.'.$data['path'])  ) {
                    $info[$key] = $data;
                    continue;
                }elseif($this->config['removetrash']){
                    call_user_func($this->config['removetrash'],$data);//删除垃圾据
                }
            }

            // 检测并创建子目录
            $subpath = $this->getSubPath($info['name']);
            if(false === $subpath){
                continue;
            } else {
                $info['savepath'] = $this->config['savepath'] . $subpath;
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
                dd($file->move('E:/Programs/wanghong/public/uploads/','E:/Programs/wanghong/storage/app/uploads/2016-10-02/aaa.png'));//移动到真实存放目录
                $fileinfo[$key] = $info;
            } else {
                return false;
            }
        }
        return empty($fileinfo) ? false : $fileinfo;
    }


    /**
     * 检查上传根目录是否存在
     * @param $rootpath
     * @return bool
     */
    private function checkRootPath($rootpath){
        if(!(is_dir($rootpath) && is_writable($rootpath))){
            $this->error = '上传根目录不存在！请尝试手动创建:'.$rootpath;
            return false;
        }
        $this->rootPath = $rootpath.'/';
        return true;
    }

    /**
     * 检测上传目录
     * @param  string $savepath 上传目录
     * @return boolean          检测结果，true-通过，false-失败
     */
    private function checkSavePath($savepath){
        /* 检测并创建目录 */
        if (!$this->mkdir($savepath)) {
            return false;
        } else {
            /* 检测目录是否可写 */
            if (!is_writable($this->rootPath . $savepath)) {
                $this->error = '上传目录 ' . $savepath . ' 不可写！';
                return false;
            } else {
                return true;
            }
        }
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
     * 获取子目录的名称
     * @param array $file  上传的文件信息
     */
    private function getSubPath($filename) {
        $subpath = '';
        $rule    = $this->config['subname'];
        if ($this->config['autosub'] && !empty($rule)) {
            $subpath = $this->getName($rule, $filename) . '/';
            if(!empty($subpath) && !$this->mkdir($this->config['savepath'] . $subpath)){
                return false;
            }
        }
        return $subpath;
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