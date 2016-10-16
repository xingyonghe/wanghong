<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPersonal extends Model{

    public $timestamps = false;//模型不需要更新/新增时间
    protected $table = 'user_personal';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $fillable = [
        'user_id','medias'
    ];
}
