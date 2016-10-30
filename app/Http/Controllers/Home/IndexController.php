<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\CommonController;

class IndexController extends CommonController{


    public function index(){
//        dd(\Auth::guest());
        return view('home.index.index');
    }



























}
