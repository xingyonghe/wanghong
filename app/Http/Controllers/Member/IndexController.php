<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\CommonController;

class IndexController extends CommonController{


    public function index(){
        $user = D('User')->with('personal')->find(auth()->id());
        return view('user.index.index');
    }





}
