<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
class IndexController extends CommonController
{
    function __construct()
    {
        parent::__construct();
    }
    //
    public function index(){
        return view('admin.index.index');
    }
}
