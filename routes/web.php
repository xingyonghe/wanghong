<?php



/**
 * 前台路由组
 */
Route::group(['namespace'=>'Home'],function(){
    //入口
    Route::get('/', 'IndexController@index')->name('home.index');
    //登陆
    Route::get('login', 'LoginController@showLoginForm')->name('home.login-form');
    Route::post('login', 'LoginController@login')->name('home.login');
    //注册
    Route::get('register', 'RegisterController@showRegistrationForm')->name('home.register-form');
    Route::post('register', 'RegisterController@register')->name('home.register');
    Route::group(['prefix'=>'home'],function(){

    });
});

/**
 * 会员中心路由组
 */
Route::group(['prefix'=>'user','namespace'=>'Member'],function(){

});

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
        Route::get ('menu/batch/{pid?}','MenuController@batch');        //批量新增
        Route::post('menu/batchUpdate', 'MenuController@batchUpdate');  //批量更新

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
        Route::get ('config/setting/{group?}',      'ConfigController@setting');       //网站设置
        Route::post('config/post',         'ConfigController@post');          //更新设置


        /**--**--**--**--**--**--**--**--**--**管理员**--**--**--**--**--**--**--**--**--**--**/

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
        Route::get ('admin/resetpass',         'AdminController@resetpass');    //重置密码
        Route::post('admin/updatepass',        'AdminController@updatepass');   //更新密码

        /**--**--**--**--**--**--**--**--**--**用户管理**--**--**--**--**--**--**--**--**--**--**/
        //普通会员
        Route::get ('personal/index',              'PersonalController@index');        //普通会员管理
        Route::get ('personal/add',                'PersonalController@add');          //添加
        Route::get ('personal/edit/{id}',          'PersonalController@edit');         //修改
        Route::post('personal/post',               'PersonalController@post');         //更新
        Route::post('personal/update',             'PersonalController@update');       //新增
        Route::get ('personal/destroy/{id}',       'PersonalController@destroy');      //删除
        Route::get ('personal/forbid/{id}',        'PersonalController@forbid');       //禁用
        Route::get ('personal/resume/{id}',        'PersonalController@resume');       //启用
        Route::get ('personal/verify/{id}',        'PersonalController@verify');       //审核
        Route::get ('personal/addCustom/{id}',     'PersonalController@addCustom');    //添加客服
        Route::post('personal/postCustom',         'PersonalController@postCustom');   //更新客服
        //广告主
        Route::get ('advertiser/index',            'AdvertiserController@index');        //广告主管理
        Route::get ('advertiser/add',              'AdvertiserController@add');          //添加
        Route::get ('advertiser/edit/{id}',        'AdvertiserController@edit');         //修改
        Route::post('advertiser/post',             'AdvertiserController@post');         //更新
        Route::post('advertiser/update',           'AdvertiserController@update');       //新增
        Route::get ('advertiser/destroy/{id}',     'AdvertiserController@destroy');      //删除
        Route::get ('advertiser/forbid/{id}',      'AdvertiserController@forbid');       //禁用
        Route::get ('advertiser/resume/{id}',      'AdvertiserController@resume');       //启用
        Route::get ('advertiser/verify/{id}',      'AdvertiserController@verify');       //审核
        Route::get ('advertiser/addCustom/{id}',   'AdvertiserController@addCustom');    //添加客服
        Route::post('advertiser/postCustom',       'AdvertiserController@postCustom');   //更新客服

        /**--**--**--**--**--**--**--**--**--**内容管理**--**--**--**--**--**--**--**--**--**--**/
        //分类管理
        Route::get ('category/add/{model}', 'CategoryController@add');          //新增
        Route::get ('category/edit/{id}',          'CategoryController@edit');         //修改
        Route::post('category/update',             'CategoryController@update');       //更新
        Route::get ('category/destroy/{id}',       'CategoryController@destroy');      //删除

        //内容管理
        Route::get ('article/index',               'ArticleController@index');        //列表
        Route::get ('article/add',                 'ArticleController@add');          //新增
        Route::get ('article/edit/{id}',           'ArticleController@edit');         //修改
        Route::post('article/update',              'ArticleController@update');       //更新
        Route::get ('article/destroy/{id}',        'ArticleController@destroy');      //删除
        Route::get ('article/category',            'ArticleController@category');     //分类列表













    });
});

/**
 * 公共路由
 */
Route::post('picture/upload', 'PictureController@upload');          //图片上传