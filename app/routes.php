<?php

Route::get('users', function()
{
    return 'Users!';
});


# 登陆与注册
Route::post('register', 'UserAccessController@register');
Route::get('register', 'UserAccessController@register');
Route::post('login','UserAccessController@login');
Route::get("/login", function(){
    $data = [
        "find_password" => "http://www.hao123.com",
        "auth_image" => "http://t11.baidu.com/it/u=254287606,1076184673&fm=58"
    ];

    return View::make("template.login_register.login")->with($data);
});
Route::get('logout','UserAccessController@logout');                      // 退出登录

#消息发送
Route::get('message','UserAccessController@sendMessage');
Route::post('message','UserAccessController@MessageCheck');

Route::post('userphoto','UserCenterController@portraitUpload');




#用户中心模块
Route::get('usercenter', array('before' => 'loginCheck', 'uses' => 'UserCenterController@index'));//用户中心首页

Route::get('usercenter/recent_month', array('before' => 'loginCheck', 'uses' => 'UserCenterController@recentMonth'));//月内订单

Route::get('usercenter/after_month', array('before' => 'loginCheck', 'uses' => 'UserCenterController@afterMonth'));//月前订单

Route::get('usercenter/collect_shop',array('before' => 'loginCheck', 'uses' => 'UserCenterController@shopCollect'));

Route::get('usercenter/collect_menu',array('before' => 'loginCheck', 'uses' => 'UserCenterController@menuCollect'));


Route::filter('loginCheck', function()
{
    if (!Auth::check())
    {
        return Redirect::to('login');
    }
});



# API/main接口，主页
Route::get('/', 'MainController@index');


# 商家
Route::get('shop/{id}', 'ShopController@index');                // 商家页面
Route::get('shop/{id}/comments', 'ShopController@shopComments');// 商家评论页
Route::post('collectshop', 'ShopController@collectShop');       // 收藏某个店铺
Route::post('collectmenu', 'ShopController@cancelShop');        // 取消收藏某个店铺



# 用户
Route::get('mail', function(){});                               // 用户提醒
Route::get('profile/security', function(){});                   // 安全设置
Route::post('addorder', 'PersonalController@addOrder');			// 添加订单
Route::post('cancelmenu', 'PersonalController@cancelMenu');     // 取消收藏商品
Route::post('cancelshop', 'PersonalController@cancelShop');     // 取消收藏店铺
Route::post('collectmenu', 'PersonalController@collectMenu');	// 收藏某个商品
Route::post('collectshop', 'PersonalController@collectShop');	// 收藏某个店铺
Route::post('confirmorder', 'PersonalController@confirmOrder');	// 确认收货
Route::post('modifyOrder', 'PersonalController@modifyOrder');	// 修改订单状态：0表示已提交未付款，1表示已付款未收货，2表示已收获，3表示取消订单



#测试
Route::get('/test/{id}', 'ShopController@getShopComments');



