<?php

namespace App\Models;

class Category extends CommonModel{
    protected $table = 'category';
    protected $fillable = [
        'name','sort', 'pid', 'model',
    ];
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
}
