<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Request;
use DB;

class UserPersonal extends Model{

    public $timestamps = false;//模型不需要更新/新增时间
    protected $table = 'user_personal';
    protected $fillable = [
        'user_id','medias'
    ];
}
