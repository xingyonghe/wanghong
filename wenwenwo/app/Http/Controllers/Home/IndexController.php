<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;

class IndexController extends Controller
{
    //
    public function index(){
        return view('home.index.index');
    }

    public function aaa(){
//        return view('home.index.index');
        return view('home.index.index');
    }
}
