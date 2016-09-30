<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TestAdd extends Model
{
    //
    protected $table = 'sys_node_copy';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];
}
