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
use think\facade\Route;
use app\middleware\compareToken;
Route::rule('/api', 'index'); // 首页访问路由

Route::rule('/login','Login/login');//登录
Route::rule('/register','Login/register');//注册
Route::rule('/getmsglist','GetData/GetFriendList')->middleware(compareToken::class);//获取好友及信息列表，登陆时访问一次
Route::rule('/getmsg','GetData/GetMsgList')->middleware(compareToken::class);//某用户的信息
Route::rule('/looked','GetData/AlreadyLook')->middleware(compareToken::class);//某用户信息已看
Route::rule('/Setmsg','GetData/SetMsg')->middleware(compareToken::class);//某用户信息已看
Route::rule('/updateUser','GetData/updateUser')->middleware(compareToken::class);//某用户信息已看
Route::rule('/addFriend','GetData/addFriend')->middleware(compareToken::class);//某用户信息已看