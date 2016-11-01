<?php

namespace App\Models;

class Media extends CommonModel{
    protected $table = 'media';
    protected $fillable = [
        'username','userid', 'avatar','type', 'platform', 'form_money', 'homepage','room_id','manner','fan','online','status'
    ];
    protected $guarded = [
        'id','created_at', 'updated_at','bespeak','accept','refuse','level'
    ];


}
