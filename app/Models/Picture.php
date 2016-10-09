<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Library\LocalUpload;
use Storage;

class Picture extends Model{

    protected $table = 'picture';
    public $timestamps = false;
    protected $fillable = [
        'url', 'path'
    ];
    protected $hidden = [
        'md5', 'sha1', 'create_time'
    ];

    /**
     * 文件上传
     * @param  array  $files   要上传的文件列表（通常是$_FILES数组）
     * @param  array  $setting 文件上传配置
     * @param  string $driver  上传驱动名称
     * @param  array  $config  上传驱动配置
     * @return array           文件上传成功后的信息
     */
    protected function upload($files, $config){
        //设置图片上传驱动
        $config['uploader'] = Storage::disk('picture');
        //设置图片上传关系表
        $config['table'] = $this->table;
        //上传
        $picture = new LocalUpload($config);
        $info   = $picture->uploads($files);
        $return  = array('status' => 1, 'info' => '上传成功');
        if($info){ //文件上传成功，记录文件信息
            foreach ($info as $key => &$value) {
                /* 已经存在文件记录 */
                if(isset($value['id']) && is_numeric($value['id'])){
                    continue;
                }
                $path = str_replace(public_path(),'',$value['rootpath']);
                $path = str_replace('\\','/',$path);
                /* 记录文件信息 */
                $value['path'] = $path.$value['savepath'].$value['savename'];	//在模板里的src路径
                unset($value['rootpath']);
                $this->fill($value);
                $this->md5 = $value['md5'];
                $this->sha1 = $value['sha1'];
                $this->create_time = date('Y-m-d H:i:s',time());
                $resualt = $this->save();
                if($resualt === false){
                    unset($info[$key]);
                }else{
                    $value['id'] = $this->id;
                }
            }
            $return = array_merge($info, $return);
        } else {
            $return['status'] = 0;
            $return['info']   = $picture->getError();
        }
        return $return;
    }

}
