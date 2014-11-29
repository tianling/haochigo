<?php


Route::get('/', function()
{
	return View::make('hello');
});


Route::get('users', function()
{
    return 'Users!';
});


# 登陆与注册
Route::post('register', 'UserAccessController@register');
Route::get('register', 'UserAccessController@register');
Route::post('login','UserAccessController@login');
Route::post('loginout', function(){});                      // 退出登录

#消息发送
Route::get('message','UserAccessController@sendMessage');


# API/main接口，主页
Route::get('/', 'MainController@index');


# 商家
Route::get('shop/{id}', 'ShopController@index');                // 商家页面
Route::get('shop/{id}/comments', 'ShopController@shopComments');// 商家评论页
Route::post('collectshop', 'ShopController@collectShop');       // 收藏某个店铺
Route::post('collectmenu', 'ShopController@cancelShop');        // 取消收藏某个店铺
Route::post('addmenu', 'ShopController@addMenu');               // 添加菜单


# 用户
Route::get('order', function(){});
Route::get('gift', function(){});                               // 礼品中心
Route::get('feedback', function(){});                           // 反馈留言地址
Route::get('cart', function(){});                               // 购物车地址
Route::get('mail', function(){});                               // 用户提醒
Route::get('switch_place', function(){});                       // 切换地址
Route::get('profile', function(){});                            // 个人中心
Route::get('profile/shop', function(){});                       // 收藏的店铺
Route::get('profile/menu', function(){});                       // 收藏的美食
Route::get('profile/security', function(){});                   // 安全设置
Route::post('cancelMenu', 'ShopController@cancelMenu');         // 取消收藏商品
Route::post('cancelShop', 'PersonalController@cancelShop');     // 取消收藏店铺


#测试
Route::get('/test/{id}', 'ShopController@getShopComments');