<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SysThumbnailRule extends Model
{
    public $timestamps = false;

    protected $table = 'sys_thumbnail_rule';
    protected $fillable = [
        'id', 'name', 'width','height','scope'
    ];

}
