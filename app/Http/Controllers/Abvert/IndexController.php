<?php

namespace App\Http\Controllers\Abvert;

use App\Http\Controllers\CommonController;

class IndexController extends CommonController{

    public function index(){
        $user = D('User')->with('advertiser')->find(auth()->id());
        return view('abvert.index.index',compact('user'));
    }

    public function edit(){
        $user = D('User')->with('advertiser')->find(auth()->id());
        return view('abvert.index.edit',compact('user'));
    }
}
