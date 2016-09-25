<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller{
    /**
     * 后台主页控制器
     */

    public function index(){
        return view('admin.index.index');
    }
}
