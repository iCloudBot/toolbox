<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//后台
Route::rule('admin/:c/:a', 'admin/:c/:a');
Route::rule('admin', function(){
    return redirect('admin/index/index');
});

Route::rule('/', 'index');
Route::rule('404', 'index/e404');
//接口
Route::rule('doapi', 'index/api');
Route::rule('api', 'index/api');
//静态页面
Route::rule('ip/:ip', 'index/index?act=ip')->pattern(['ip' => '.*']);
Route::rule(':act','index/index');
