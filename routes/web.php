<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/home/image', function(){
    $img = Image::make('JS.png')->resize(800, 600);
    return $img->response('jpg');
});

/**
 * 前台路由组
 */

/**
 * 会员中心路由组
 */

/**
 * 后台路由组
 */
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){

    Route::get('/', 'LoginController@showLoginForm');//登录
    Route::post('login', 'LoginController@login');//登录提交
    Route::get('logout', 'LoginController@logout');//退出登录
    //
    Route::group(['middleware'=>['admin.auth','menu']],function (){
        //首页
        Route::get('index/index', 'IndexController@index');//首页

        /**--**--**--**--**--**--**--**--**--**系统**--**--**--**--**--**--**--**--**--**--**/
        //菜单管理
        Route::get ('menu/index',       'MenuController@index');        //列表
        Route::get ('menu/add',         'MenuController@add');          //新增
        Route::get ('menu/edit/{id}',   'MenuController@edit');         //修改
        Route::post('menu/update',      'MenuController@update');       //更新
        Route::get ('menu/destroy/{id}','MenuController@destroy');      //删除
        //导航管理
        Route::get ('channel/index',       'ChannelController@index');        //列表
        Route::get ('channel/add',         'ChannelController@add');          //新增
        Route::get ('channel/edit/{id}',   'ChannelController@edit');         //修改
        Route::post('channel/update',      'ChannelController@update');       //更新
        Route::get ('channel/destroy/{id}','ChannelController@destroy');      //删除
        Route::get ('channel/sort',        'ChannelController@sort');         //排序
        Route::post('channel/postSort',    'ChannelController@postSort');     //更新排序
        //网站设置、配置
        Route::get ('config/index',        'ConfigController@index');         //配置列表
        Route::get ('config/add',          'ConfigController@add');           //新增配置
        Route::get ('config/edit/{id}',    'ConfigController@edit');          //修改配置
        Route::post('config/update',       'ConfigController@update');        //更新配置
        Route::get ('config/destroy/{id}', 'ConfigController@destroy');       //删除配置
        Route::get ('config/sort',         'ConfigController@sort');          //配置排序
        Route::post('config/postSort',     'ConfigController@postSort');      //更新排序
        Route::get ('config/setting',      'ConfigController@setting');       //网站设置
        Route::post('config/post',         'ConfigController@post');          //更新设置
        /**--**--**--**--**--**--**--**--**--**用户**--**--**--**--**--**--**--**--**--**--**/

        //权限管理
        Route::get ('auth/index',              'AuthController@index');        //列表
        Route::get ('auth/group',              'AuthController@group');        //用户组列表
        Route::get ('auth/addGroup',           'AuthController@addGroup');     //新增用户组
        Route::get ('auth/editGroup/{id}',     'AuthController@editGroup');    //修改用户组
        Route::post('auth/updateGroup',        'AuthController@updateGroup');  //更新用户组
        Route::get ('auth/destroyGroup/{id}',  'AuthController@destroyGroup'); //删除用户组
        Route::get ('auth/access/{id}',        'AuthController@access');       //用户组授权
        Route::post('auth/writeGroup',         'AuthController@writeGroup');   //用户组授权写入
        //管理员
        Route::get ('admin/index',             'AdminController@index');        //列表
        Route::get ('admin/add',               'AdminController@add');          //新增
        Route::post('admin/update',            'AdminController@update');       //添加管理员
        Route::get ('admin/edit/{id}',         'AdminController@edit');         //修改
        Route::post('admin/editUpdate',        'AdminController@editUpdate');   //修改管理员
        Route::get ('admin/forbid/{id}',       'AdminController@forbid');       //禁用
        Route::get ('admin/resume/{id}',       'AdminController@resume');       //启用
        Route::get ('admin/destroy/{id}',      'AdminController@destroy');      //删除
        Route::get ('admin/destroy/{id}',      'AdminController@destroy');      //删除
        Route::get ('admin/resetpass',         'AdminController@resetpass');    //重置密码
        Route::post('admin/updatepass',        'AdminController@updatepass');   //更新密码



    });
});