<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SysAdmin extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sys_admin';

    protected $dateFormat = 'U';
    public $timestamps = false;         //是否有created_at和updated_at字段
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];
}
