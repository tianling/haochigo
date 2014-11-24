<?php


Route::get('/', function()
{
	return View::make('hello');
});


Route::get('users', function()
{
    return 'Users!';
});



Route::post('register', 'UserAccessController@register');
Route::get('register', 'UserAccessController@register');


Route::post('login','UserAccessController@login');

Route::get('message','UserAccessController@sendMessage');



Route::get('/', function(){
    $data = [
        "pic_swap" => [
            0 => [
                "image_url" => "http://gtms02.alicdn.com/tps/i2/TB1OK_uGXXXXXXwXVXXnLSnFXXX-880-70.png",
                "jump_url" => "1231"
            ],
            1 => [
                "image_url" => "http://gtms02.alicdn.com/tps/i2/TB1OK_uGXXXXXXwXVXXnLSnFXXX-880-70.png",
                "jump_url" => "1231231"
            ]
        ],

        "side_bar" => [
            "QR_code" => "http=>//db.jpg",
            "open_shop" => "http=>//shop",
            "hot_question" => "http=>//hot_question"
        ],

        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],


        "my_store" => [
            "url" => "###",
            "data" => [
                [
                    "shop_id" => "123435",
                    "place_id" => "589u65487945",
                    "shop_url" => "http://www.baidu.com",
                    "shop_logo" => url("images/5c81fa9884117928491470659e18djpeg.jpeg"),
                    "deliver_time" => "22",
                    "deliver_start" => "17:00",
                    "shop_name" => "三顾冒菜",
                    "shop_type" => "中餐",
                    "shop_level" => "4.3",
                    "order_count" => "202",
                    "is_opening" => "0",
                    "is_ready_for_order" => "1"
                ],
                [
                    "shop_id" => "124124345",
                    "place_id" => "234534",
                    "shop_url" => "##",
                    "shop_logo" => url("images/5c81fa9884117928491470659e18djpeg.jpeg"),
                    "deliver_time" => "45",
                    "deliver_start" => "",
                    "shop_name" => "乐堡王",
                    "shop_type" => "中式，西式",
                    "shop_level" => "4.3",
                    "order_count" => "5134",
                    "is_opening" => "0",
                    "is_ready_for_order" => "0"
                ],
                [
                    "shop_id" => "45675656",
                    "place_id" => "435456456436346346346",
                    "shop_url" => "##",
                    "shop_logo" => "",
                    "deliver_time" => "",
                    "deliver_start" => "",
                    "shop_name" => "铁板牛肉",
                    "shop_type" => "中餐",
                    "shop_level" => "3.8",
                    "order_count" => "202",
                    "is_opening" => "2",
                    "is_ready_for_order" => "0"
                ]
            ]
        ],



        "shop_list" => [
            "data" =>  [
                // 考虑到以后活动会换， 在前端进行筛选的时候， 会通过activity_id 进行筛选
                "activity" => [
                    1 => "新店开张，欢迎光临",
                    2 => "首单立减8元",
                    3 => "在线支付，10元减5元"
                ],
                "shops" => [
                    [
                        "support_activity" => [2,3],       // 所有支持的活动的id
                        "isHot" => true,                  // 是否是热门餐厅
                        "isOnline" => true,                    // 是否营业
                        "isSupportPay" => true,                   // 是否支持在线支付
                        "flavor" => "中式" ,                  // 餐厅口味
                        "shop_id" => "456"    ,                         // 商家id
                        "place_id" => "123"   ,                        // 商家位置id
                        "shop_url" => "http://baidu.com"   ,                       // 点击跳转到相应商家
                        "shop_logo" => ""  ,                      // 商家的logo图片地址
                        "deliver_time" => "22",                     // 送货时间间隔
                        "deliver_start" => "10:00" ,                    // 送货开始时间
                        "shop_name" => "臭脚丫"       ,                   // 商家名称
                        "shop_type" => "美食"        ,                  // 商家类型
                        "shop_level" => "3.8"       ,                 // 总共10个等级, 1个半星一个等级
                        "shop_announce" => "臭脚丫专卖店"      ,                // 商家公告
                        "deliver_state_start" => "100块都不送",
                        "deliver_start_statement" => "顺丰快递,耶"        ,               // 起送价描述, 注意,这是一段话
                        "shop_address" => "黄脚丫"          ,             // 商家地址
                        "is_opening"  => "0"            ,            // 0 是正在营业, 1是打烊了
                        "close_msg"  => "关门啦"             ,           // 关门信息
                        "business_hours" => "08:00"           ,          // 营业时间
                        "shop_summary" => "lalalal"              ,         // 商家简介
                        "order_count"=> "22"               ,       // 订单数量
                        "is_collected" => ""                 ,      // 是否被收藏了
                        "is_ready_for_order" => "1",
                        "additions" => [                          // 额外的内容
                            0 => [
                                "add_img" => ""   ,                 // 额外内容的图片地址, 这里会显示一个配字样的图片
                                "add_content" => "配送费3元"  ,     // 额外内容
                            ]
                        ]
                    ],[
                        "support_activity" => [1,2],       // 所有支持的活动的id
                        "isHot" => true,                  // 是否是热门餐厅
                        "isOnline" => true,                    // 是否营业
                        "isSupportPay" => true,                   // 是否支持在线支付
                        "flavor" => "中式" ,                  // 餐厅口味
                        "shop_id" => "456"    ,                         // 商家id
                        "place_id" => "123"   ,                        // 商家位置id
                        "shop_url" => "http://baidu.com"   ,                       // 点击跳转到相应商家
                        "shop_logo" => ""  ,                      // 商家的logo图片地址
                        "deliver_time" => "22",                     // 送货时间间隔
                        "deliver_start" => "10:00" ,                    // 送货开始时间
                        "shop_name" => "臭脚丫"       ,                   // 商家名称
                        "shop_type" => "美食"        ,                  // 商家类型
                        "shop_level" => "3.8"       ,                 // 总共10个等级, 1个半星一个等级
                        "shop_announce" => "臭脚丫专卖店"      ,                // 商家公告
                        "deliver_state_start" => "100块都不送",
                        "deliver_start_statement" => "顺丰快递,耶"        ,               // 起送价描述, 注意,这是一段话
                        "shop_address" => "黄脚丫"          ,             // 商家地址
                        "is_opening"  => "0"            ,            // 0 是正在营业, 1是打烊了
                        "close_msg "  => "关门啦"             ,           // 关门信息
                        "business_hours" => "08:00"           ,          // 营业时间
                        "shop_summary" => "lalalal"              ,         // 商家简介
                        "order_count"=> "22"               ,       // 订单数量
                        "is_collected" => ""                 ,      // 是否被收藏了
                        "is_ready_for_order" => "1",
                        "additions" => [                          // 额外的内容
                            0 => [
                                "add_img" => ""   ,                 // 额外内容的图片地址, 这里会显示一个配字样的图片
                                "add_content" => "配送费3元"  ,     // 额外内容
                            ]
                        ]
                    ],[
                        "support_activity" => [1,2],       // 所有支持的活动的id
                        "isHot" => true,                  // 是否是热门餐厅
                        "isOnline" => true,                    // 是否营业
                        "isSupportPay" => true,                   // 是否支持在线支付
                        "flavor" => "中式" ,                  // 餐厅口味
                        "shop_id" => "456"    ,                         // 商家id
                        "place_id" => "123"   ,                        // 商家位置id
                        "shop_url" => "http://baidu.com"   ,                       // 点击跳转到相应商家
                        "shop_logo" => ""  ,                      // 商家的logo图片地址
                        "deliver_time" => "22",                     // 送货时间间隔
                        "deliver_start" => "10:00" ,                    // 送货开始时间
                        "shop_name" => "臭脚丫"       ,                   // 商家名称
                        "shop_type" => "美食"        ,                  // 商家类型
                        "shop_level" => "3.8"       ,                 // 总共10个等级, 1个半星一个等级
                        "shop_announce" => "臭脚丫专卖店"      ,                // 商家公告
                        "deliver_state_start" => "100块都不送",
                        "deliver_start_statement" => "顺丰快递,耶"        ,               // 起送价描述, 注意,这是一段话
                        "shop_address" => "黄脚丫"          ,             // 商家地址
                        "is_opening"  => "0"            ,            // 0 是正在营业, 1是打烊了
                        "close_msg "  => "关门啦"             ,           // 关门信息
                        "business_hours" => "08:00"           ,          // 营业时间
                        "shop_summary" => "lalalal"              ,         // 商家简介
                        "order_count"=> "22"               ,       // 订单数量
                        "is_collected" => ""                 ,      // 是否被收藏了
                        "is_ready_for_order" => "1",
                        "additions" => [                          // 额外的内容
                            0 => [
                                "add_img" => ""   ,                 // 额外内容的图片地址, 这里会显示一个配字样的图片
                                "add_content" => "配送费3元"  ,     // 额外内容
                            ]
                        ]
                    ],[
                        "support_activity" => [1,3],       // 所有支持的活动的id
                        "isHot" => true,                  // 是否是热门餐厅
                        "isOnline" => true,                    // 是否营业
                        "isSupportPay" => true,                   // 是否支持在线支付
                        "flavor" => "中式" ,                  // 餐厅口味
                        "shop_id" => "456"    ,                         // 商家id
                        "place_id" => "123"   ,                        // 商家位置id
                        "shop_url" => "http://baidu.com"   ,                       // 点击跳转到相应商家
                        "shop_logo" => ""  ,                      // 商家的logo图片地址
                        "deliver_time" => "22",                     // 送货时间间隔
                        "deliver_start" => "10:00" ,                    // 送货开始时间
                        "shop_name" => "臭脚丫"       ,                   // 商家名称
                        "shop_type" => "美食"        ,                  // 商家类型
                        "shop_level" => "3.8"       ,                 // 总共10个等级, 1个半星一个等级
                        "shop_announce" => "臭脚丫专卖店"      ,                // 商家公告
                        "deliver_state_start" => "100块都不送",
                        "deliver_start_statement" => "顺丰快递,耶"        ,               // 起送价描述, 注意,这是一段话
                        "shop_address" => "黄脚丫"          ,             // 商家地址
                        "is_opening"  => "0"            ,            // 0 是正在营业, 1是打烊了
                        "close_msg "  => "关门啦"             ,           // 关门信息
                        "business_hours" => "08:00"           ,          // 营业时间
                        "shop_summary" => "lalalal"              ,         // 商家简介
                        "order_count"=> "22"               ,       // 订单数量
                        "is_collected" => ""                 ,      // 是否被收藏了
                        "is_ready_for_order" => "1",
                        "additions" => [                          // 额外的内容
                            0 => [
                                "add_img" => ""   ,                 // 额外内容的图片地址, 这里会显示一个配字样的图片
                                "add_content" => "配送费3元"  ,     // 额外内容
                            ]
                        ]
                    ],[
                        "support_activity" => [2,3],       // 所有支持的活动的id
                        "isHot" => true,                  // 是否是热门餐厅
                        "isOnline" => true,                    // 是否营业
                        "isSupportPay" => true,                   // 是否支持在线支付
                        "flavor" => "中式" ,                  // 餐厅口味
                        "shop_id" => "456"    ,                         // 商家id
                        "place_id" => "123"   ,                        // 商家位置id
                        "shop_url" => "http://baidu.com"   ,                       // 点击跳转到相应商家
                        "shop_logo" => ""  ,                      // 商家的logo图片地址
                        "deliver_time" => "22",                     // 送货时间间隔
                        "deliver_start" => "10:00" ,                    // 送货开始时间
                        "shop_name" => "臭脚丫"       ,                   // 商家名称
                        "shop_type" => "美食"        ,                  // 商家类型
                        "shop_level" => "3.8"       ,                 // 总共10个等级, 1个半星一个等级
                        "shop_announce" => "臭脚丫专卖店"      ,                // 商家公告
                        "deliver_state_start" => "100块都不送",
                        "deliver_start_statement" => "顺丰快递,耶"        ,               // 起送价描述, 注意,这是一段话
                        "shop_address" => "黄脚丫"          ,             // 商家地址
                        "is_opening"  => "0"            ,            // 0 是正在营业, 1是打烊了
                        "close_msg "  => "关门啦"             ,           // 关门信息
                        "business_hours" => "08:00"           ,          // 营业时间
                        "shop_summary" => "lalalal"              ,         // 商家简介
                        "order_count"=> "22"               ,       // 订单数量
                        "is_collected" => ""                 ,      // 是否被收藏了
                        "is_ready_for_order" => "1",
                        "additions" => [                          // 额外的内容
                            0 => [
                                "add_img" => ""   ,                 // 额外内容的图片地址, 这里会显示一个配字样的图片
                                "add_content" => "配送费3元"  ,     // 额外内容
                            ]
                        ]
                    ]
                ]
            ]
        ],
        "add_image" => [
            "data" => [
                [
                    "image_url" => "###",
                    "jump_url" => "##",
                ],
                [
                    "image_url" => "###",
                    "jump_url" => "##",
                ],
                [
                    "image_url" => "###",
                    "jump_url" => "##",
                ],
                [
                    "image_url" => "###",
                    "jump_url" => "##",
                ],
                [
                    "image_url" => "###",
                    "jump_url" => "##",
                ]
            ]
        ],
        "more_shop" => [
            "data" => [
                [
                    "shop_id" => "12423235235235",
                    "place_id" => "12423235235235",
                    "support_activity" => [1,2,3],
                    "isHot" => "1",
                    "isOnline" => "1",
                    "isSupportPay" => "1",
                    "shop_url" => "http://www.baidu.com",
                    "shop_logo" => url("images/5c81fa9884117928491470659e18djpeg.jpeg"),
                    "deliver_time" => "22",
                    "deliver_start" => "17:00",
                    "shop_name" => "三顾冒菜",
                    "shop_type" => "中餐",
                    "shop_level" => "4.3",
                    "shop_announce" => "吃吃吃，吃个屁",
                    "deliver_state_start" => "100块都不送",
                    "shop_address" => "堕落街",
                    "business_hours" => "24小时",
                    "shop_summary"  => "吃吃吃",
                    "order_count" => "202",
                    "is_collected" => "0",
                    "is_opening" => "0",
                    "is_ready_for_order" => "1"
                ],
                [
                    "shop_id" => "12423235235235",
                    "place_id" => "12423235235235",
                    "support_activity" => [1,2,3],
                    "isHot" => "1",
                    "isOnline" => "1",
                    "isSupportPay" => "1",
                    "shop_url" => "http://www.baidu.com",
                    "shop_logo" => url("images/5c81fa9884117928491470659e18djpeg.jpeg"),
                    "deliver_time" => "22",
                    "deliver_start" => "17:00",
                    "shop_name" => "三顾冒菜",
                    "shop_type" => "中餐",
                    "shop_level" => "4.3",
                    "shop_announce" => "吃吃吃，吃个屁",
                    "deliver_state_start" => "100块都不送",
                    "shop_address" => "堕落街",
                    "business_hours" => "24小时",
                    "shop_summary"  => "吃吃吃",
                    "order_count" => "202",
                    "is_collected" => "0",
                    "is_opening" => "0",
                    "is_ready_for_order" => "1"
                ],
                [
                    "support_activity" => [1,2,3],
                    "shop_id" => "12423235235235",
                    "place_id" => "12423235235235",
                    "isHot" => "1",
                    "isOnline" => "1",
                    "isSupportPay" => "1",
                    "shop_url" => "##",
                    "shop_logo" => url("images/5c81fa9884117928491470659e18djpeg.jpeg"),
                    "deliver_time" => "45",
                    "deliver_start" => "",
                    "shop_name" => "乐堡王",
                    "shop_type" => "中式，西式",
                    "shop_level" => "4.3",
                    "shop_announce" => "吃吃吃，吃个屁",
                    "deliver_state_start" => "100块都不送",
                    "shop_address" => "堕落街A区",
                    "business_hours" => "24小时",
                    "shop_summary"  => "吃",
                    "is_collected" => "1",
                    "order_count" => "5134",
                    "is_opening" => "0",
                    "is_ready_for_order" => "0"
                ],
                [
                    "shop_id" => "12423235235235",
                    "place_id" => "12423235235235",
                    "support_activity" => [1,2,3],
                    "isHot" => "1",
                    "isOnline" => "1",
                    "isSupportPay" => "1",
                    "shop_url" => "##",
                    "shop_logo" => "",
                    "deliver_time" => "",
                    "deliver_start" => "",
                    "shop_name" => "铁板牛肉",
                    "shop_type" => "中餐",
                    "shop_level" => "3.8",
                    "shop_announce" => "吃吃吃，吃个屁",
                    "deliver_state_start" => "送送送",
                    "shop_address" => "堕落街B区",
                    "business_hours" => "6：00 - 10：00",
                    "shop_summary"  => "吃个屁",
                    "is_collected" => "0",
                    "order_count" => "202",
                    "is_opening" => "2",
                    "is_ready_for_order" => "0"
                ],
                [
                    "shop_id" => "12423235235235",
                    "place_id" => "12423235235235",
                    "support_activity" => [1,2,3],
                    "isHot" => "1",
                    "isOnline" => "1",
                    "isSupportPay" => "1",
                    "shop_url" => "##",
                    "shop_logo" => "",
                    "deliver_time" => "",
                    "deliver_start" => "",
                    "shop_name" => "铁板牛肉",
                    "shop_type" => "中餐",
                    "shop_level" => "3.8",
                    "shop_announce" => "吃吃吃，吃个屁",
                    "deliver_state_start" => "送送送",
                    "shop_address" => "堕落街B区",
                    "business_hours" => "6：00 - 10：00",
                    "shop_summary"  => "吃个屁",
                    "is_collected" => "0",
                    "order_count" => "202",
                    "is_opening" => "2",
                    "is_ready_for_order" => "0"
                ],
                [
                    "shop_id" => "12423235235235",
                    "place_id" => "12423235235235",
                    "support_activity" => [1,2,3],
                    "isHot" => "1",
                    "isOnline" => "1",
                    "isSupportPay" => "1",
                    "shop_url" => "##",
                    "shop_logo" => "",
                    "deliver_time" => "",
                    "deliver_start" => "",
                    "shop_name" => "铁板牛肉",
                    "shop_type" => "中餐",
                    "shop_level" => "3.8",
                    "shop_announce" => "吃吃吃，吃个屁",
                    "deliver_state_start" => "送送送",
                    "shop_address" => "堕落街B区",
                    "business_hours" => "6：00 - 10：00",
                    "shop_summary"  => "吃个屁",
                    "is_collected" => "0",
                    "order_count" => "202",
                    "is_opening" => "2",
                    "is_ready_for_order" => "0"
                ]
            ]
        ]
    ];

    return View::make('template.home.home')->with($data);
});

Route::get("shop", function() {
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "top_bar" => [
            "url" => [
                "return_back" => "##",               // 返回主页的地址
                "shop_url" =>  "###",                // 当前商家的地址
                "comment_url" => "####",               // 商家评论页的地址
                "menu_url"  => "#####",                 // 美食墙的地址
                "message_url" => "#######",               // 商家留言的地址
                "map_url" => "########",                //地图地址
            ],

            "data" => [
                "shop_id" => "123",                    // 商家id
                "place_id" => "12345",                   // 商家位置id
                "shop_logo" => "http://localhost:8080/images/5c81fa9884117928491470659e18djpeg.jpeg",                  // 商家的logo图片地址
                "shop_name" => "撒拉尔人家",                  // 商家名称
                "shop_type" => "中式",                  // 商家类型
                "shop_level" => [                  // 总共10个等级, 1个半星一个等级
                    "level_5" => "66",              // 评论为5星的比例
                    "level_4" => "17",              // 评论为4星的比例
                    "level_3" => "7",               // 评论为3星的比例
                    "level_2" => "2",               // 评论为2星的比例
                    "level_1" => "8",               // 评论为1星的比例
                ],
                "shop_total"   => "4.5",                // 总评价
                "comment_count" => "500",              // 评论人数
                "shop_statement" => "叫外卖上饿了么",             // 商家简介
                "shop_time"     => "09:50 - 13:30 / 16:00 - 19:30", // 商家开门时间 (纯字符串, 应该是商家自己写上去的)
                "shop_address"  => "重庆邮电大学堕落街",              // 商家地址
                "deliver_begin" => "19:30",         // 送餐开始时间
                "shop_distance" => "400",           // 商家距离(米)
                "price_begin"   => "15",              // 起送价
                "is_collected" => "1",               // 是否被收藏了
                "shop_remark" => "傻逼"               //额外说明
            ]
        ],


        "announcement" => [
            "data" => [
                "announce_content" => "餐厅公告内容餐厅公告内容餐厅公告内容餐厅公告内容餐厅公告内容餐厅公告内容",              // 餐厅公告内容
                "start_price"      => "99999",              // 起送价
                "activities"       => [               // 商家活动
                    [
                        "activity_name" => "该餐厅支持在线支付", // 活动标题
                        "activity_icon" => "online-payment"          // 活动图标
                    ],
                    [
                        "activity_name" => "满10-3", // 活动标题
                        "activity_icon" => "extra-discount"          // 活动图标
                    ]
                ]
            ]
        ],

        "category" => [
            "data" => [
                "classify_sec" => [
                    0 => [
                        "classify_name" => "10元管饱",  // 类别名称
                        "classify_id"   => "123"  ,        // 类别id
                        "classify_icon"  => "http://fuss10.elemecdn.com/c/12/d2b0ed6e994997099e86581009d3bjpeg.jpeg"  ,       // 类别图标地址
                        "activity_ads" => [          // 这个种类是不是活动, 不是则为空
                            "activity_name" => "" ,      // 活动标题
                            "activity_statement" => ""  // 活动描述
                        ],
                        "classify_images" => [           // 有的类别会有图片, 如果没有,这个为空数组
                            0 => [
                                "goods_id" => "",       // 商品id
                                "goods_image" => "",     // 商品图片地址
                                "goods_name" => "" ,    // 商品名称
                                "goods_level" => "" ,   // 商品等级, 总共10个等级
                                "comment_count" => "",  // 投票人数
                                "goods_sails" => ""   , // 商品销量
                                "goods_price" => ""    , // 商品价格
                                "goods_icon" => ""    , // 一些用户促销的图标
                                "goods_original" => "" // 如果是促销, 这个用于显示原价
                            ]
                        ],
                        "classify_goods" => [
                            0 => [
                                "goods_id" => ""    ,   // 商品id
                                "goods_name" => ""   ,  // 商品名称
                                "goods_level" => "" ,   // 商品等级, 总共10个等级
                                "comment_count" => "",  // 投票人数
                                "goods_price" => "",    // 商品价格
                                "goods_icon" =>  "",    // 一些用户促销的图标
                                "goods_original" => "" // 如果是促销, 这个用于显示原价
                            ]
                        ]
                    ]
                ]
            ]
        ],
        "good_category" => [
            "data" => [
                "goods_category" => [
                    [
                        "classify_name" => "10元管饱",  // 类别名称
                        "classify_name_abbr" => "点餐就包拿！没办…",  // 类别名称简写
                        "classify_id"  => "1",          // 类别id
                        "classify_count" => "23",       // 类别中有多少商品
                        "classify_icon" => "123",         // 类别图标地址
                    ],
                    [
                        "classify_name" => "10元管饱",  // 类别名称
                        "classify_name_abbr" => "点餐就包拿！没办…",  // 类别名称简写
                        "classify_id"  => "",          // 类别id
                        "classify_count" => "23",       // 类别中有多少商品
                        "classify_icon" => "",         // 类别图标地址
                    ],
                    [
                        "classify_name" => "10元管饱",  // 类别名称
                        "classify_name_abbr" => "点就有红包拿！没办…",  // 类别名称简写
                        "classify_id"  => "",          // 类别id
                        "classify_count" => "23",       // 类别中有多少商品
                        "classify_icon" => "",         // 类别图标地址
                    ],
                    [
                        "classify_name" => "10元管饱",  // 类别名称
                        "classify_name_abbr" => "点红包拿！办…",  // 类别名称简写
                        "classify_id"  => "",          // 类别id
                        "classify_count" => "23",       // 类别中有多少商品
                        "classify_icon" => "",         // 类别图标地址
                    ],
                    [
                        "classify_name" => "10元管饱",  // 类别名称
                        "classify_name_abbr" => "点餐就有红包办…",  // 类别名称简写
                        "classify_id"  => "",          // 类别id
                        "classify_count" => "23",       // 类别中有多少商品
                        "classify_icon" => "",         // 类别图标地址
                    ],
                    [
                        "classify_name" => "10元管饱",  // 类别名称
                        "classify_name_abbr" => "点餐有红包拿！没办…",  // 类别名称简写
                        "classify_id"  => "",          // 类别id
                        "classify_count" => "23",       // 类别中有多少商品
                        "classify_icon" => "",         // 类别图标地址
                    ],
                    [
                        "classify_name" => "10元管饱",  // 类别名称
                        "classify_name_abbr" => "点餐…",  // 类别名称简写
                        "classify_id"  => "",          // 类别id
                        "classify_count" => "23",       // 类别中有多少商品
                        "classify_icon" => "",         // 类别图标地址
                    ]
                ],
                "good_activity" => [
                    [
                        "activity_name" => "1元秒杀（限新用户）重庆",  // 活动名称
                        "activity_id" => "123",                      // 活动id
                        "activity_icon" => "123",                       // 活动图标地址
                        "activity_statement" => "1元秒杀爽到爆！"      // 活动简洁
                    ],
                    [
                        "activity_name" => "1元秒杀（限新用户）重庆",  // 活动名称
                        "activity_id" => "123",                      // 活动id
                        "activity_icon" => "",                       // 活动图标地址
                        "activity_statement" => "1元秒杀爽到爆！"      // 活动简洁
                    ],
                    [
                        "activity_name" => "1元秒杀（限新用户）重庆",  // 活动名称
                        "activity_id" => "123",                      // 活动id
                        "activity_icon" => "",                       // 活动图标地址
                        "activity_statement" => "1元秒杀爽到爆！"      // 活动简洁
                    ],
                    [
                        "activity_name" => "1元秒杀（限新用户）重庆",  // 活动名称
                        "activity_id" => "123",                      // 活动id
                        "activity_icon" => "",                       // 活动图标地址
                        "activity_statement" => "1元秒杀爽到爆！"      // 活动简洁
                    ]
                ]
            ]
        ]
    ];

    return View::make("template.shop.shop")->with($data);
});

Route::get("/login", function(){
    $data = [
        "find_password" => "http://www.hao123.com",
        "auth_image" => "http://t11.baidu.com/it/u=254287606,1076184673&fm=58"
    ];

    return View::make("template.login_register.login")->with($data);
});

Route::get("/register", function(){
    $data = [
        "auth_image" => "http://t11.baidu.com/it/u=254287606,1076184673&fm=58"        //验证码
    ];

    return View::make("template.login_register.register")->with($data);

});




Route::get("/personal_center", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ],

        "personal" => [
            "user_image" =>  "", // 用户头像
            "user_name"  =>  "DB", // 用户姓名
            "user_level" =>  "1", // 用户安全等级 0 是 low 1 是中等 2 是高 3 是满分
            "user_balance" => "20", // 用户余额
            "charge" =>   "http://baidu.com",   // 跳转到充值的地址
            "user_collect" => [
                "restaurant" => "123",   // 餐厅数量
                "cate"       => "2"   // 美食数量
            ],
            "user_order"  => "22",  // 用户订单数量
            "recent_order"  => [
                0 => [
                    "order_number" => "123",  // 订单号
                    "order_time"   => "2014-10-20",  // 下单时间
                    "order_restaurant" =>  "DB", // 订单餐厅
                    "order_details" => "XXXX 商店", // 订单详情
                    "order_state" => "无效订单"   // 订单状态
                ]
            ],
            "recent_deal" =>  [
                0 => [
                    "deal_time"  => "2014-10-22",     // 交易时间
                    "deal_type"  => "充值",     // 交易类型
                    "deal_details" => "2323232- 订单号: 23232323",   // 交易详情
                    "deal_money" =>  [
                        "money_type" => "0",  // 0是增加 1 是减少
                        "money_sum"  => "23"   // 金额数额
                    ],
                    "deal_status"  => "成功"   // 交易状态
                ]
            ],
            "more_deal" => ""     // 收支明细的地址
        ]

    ];

    return View::make("template.personal.personal_center")->with($data);
});

Route::get("/personal_after_month", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ],

        "after_month" => [
            "deal_count" => "11",
            "deal" => [
                [
                    "shop_id" => "111123",
                    "deal_id" => "123",
                    "deal_statue" => "3",
                    "same_again" => "##",
                    "deal_is_retrun" => "1",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "0",
                    "deal_satisfied" => "0",
                    "good" => [
                        [
                            "goods_id" => "111123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "111123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "2"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "红烧肉",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ],
                [
                    "shop_id" => "123",
                    "deal_id" => "123",
                    "deal_statue" => "0",
                    "same_again" => "##",
                    "deal_is_retrun" => "0",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "75分钟",
                    "deal_satisfied" => "0",
                    "good" => [
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "减减减",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ],
                [
                    "shop_id" => "123",
                    "deal_id" => "123",
                    "deal_statue" => "1",
                    "same_again" => "##",
                    "deal_is_retrun" => "1",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "5分钟",
                    "deal_satisfied" => "0",
                    "good" => [
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "红烧肉",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ],
                [
                    "shop_id" => "123",
                    "deal_id" => "123",
                    "deal_statue" => "2",
                    "same_again" => "##",
                    "deal_is_retrun" => "1",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "5分钟",
                    "deal_satisfied" => "1",
                    "good" => [
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "红烧肉",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ]
            ]
        ]
    ];

    return View::make("template.personal.personal_after_month")->with($data);
});

Route::get("/personal_change_password", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ]
    ];

    return View::make("template.personal.personal_change_password")->with($data);
});

Route::get("/personal_change_password", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ]
    ];

    return View::make("template.personal.personal_change_password")->with($data);
});

Route::get("/personal_collection_goods", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ],
        "good_count" => "",     // 收藏的商品数量
        "goods" => [
            0 => [
                "good_id" => "1",   // 商品id
                "good_name" => "DB", // 商品名称
                "shop_name" => "SB店", // 商品归属的商店的名称
                "shop_id"   => "2", // 商品归属的商店的id
                "shop_href" => "http://baidu.com" , // 商品在商店的链接
                "order_href" => "http://baidu.com", // 商品订购按钮链接
                "good_price" => "10090900", // 商品的价格
                "delete_good" => "http://baidu.com", // 删除商品的链接
                "shop_hot" => "232"   // 商店人气(也就是所有商品的销量)
            ]
        ]
    ];

    return View::make("template.personal.personal_collection_goods")->with($data);
});

Route::get("/personal_collection_shop", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ],
        "shops"	=> [
            "now_shop_count" => "23",    // 收藏的商家数量
            "now_area"  => "重庆",    // 当前商店区域
            "other_shop_count" => "12",   // 其他地方收藏的数量
            "now_place" => [
                0 => [
                    "shop_id"   =>  "2323",    // 商店id
                    "shop_name" => "DB 店",     // 商店名称
                    "shop_logo" => url("/images/1ff6ee89a2f110f2f1c424eac9ef3jpeg.jpg") ,    // 商店logo
                    "shop_type" => "傻逼" ,    // 商店类型
                    "shop_url" => "http://baidu.com" ,     // 点击商店跳转的链接
                    "shop_level" => "2.2",    // 商店等级
                    "deliver_time" => "24",  // 送货时间
                    "shop_statue" => "0" ,  // 商店状态 (是否打烊) 0 是营业 1 是关门
                    "goods_count" => "12"    // 订单数量
                ]
            ],
            "other_place" => [
                0 => [
                    "shop_id"   =>  "sad",    // 商店id
                    "shop_name" => "DB 店",     // 商店名称
                    "shop_logo" => url("/images/1ff6ee89a2f110f2f1c424eac9ef3jpeg.jpg") ,    // 商店logo
                    "shop_type" => "傻逼" ,    // 商店类型
                    "shop_url" => "http://baidu.com" ,     // 点击商店跳转的链接
                    "shop_level" => "2.2",    // 商店等级
                    "deliver_time" => "24",  // 送货时间
                    "shop_statue" => "0" ,  // 商店状态 (是否打烊) 0 是营业 1 是关门
                    "goods_count" => "12"    // 订单数量
                ],
                1 => [
                    "shop_id"   =>  "sad",    // 商店id
                    "shop_name" => "DB 店",     // 商店名称
                    "shop_logo" => url("/images/1ff6ee89a2f110f2f1c424eac9ef3jpeg.jpg") ,    // 商店logo
                    "shop_type" => "傻逼" ,    // 商店类型
                    "shop_url" => "http://baidu.com" ,     // 点击商店跳转的链接
                    "shop_level" => "2.2",    // 商店等级
                    "deliver_time" => "24",  // 送货时间
                    "shop_statue" => "1" ,  // 商店状态 (是否打烊) 0 是营业 1 是关门
                    "goods_count" => "12"    // 订单数量
                ]
            ]
        ]
    ];

    return View::make("template.personal.personal_collection_shop")->with($data);
});

Route::get("/personal_details", function(){
    $data = [
        "personal_details"=>[
            "url" => [
                "all" => "__link_all__",   // 全部收支的链接
                "takeout" => "__link_takeout__", // 外卖收支的链接
                "charge" => "__link_charge__",  // 用户充值收支的链接
                "refund" => "__link_refund__",  // 退款收支的链接
                "today" => "__link_today__",  // 今天的链接
                "sevenday" => "__link_sevenday__",  // 近七天的链接
                "fifteenday" => "__link_fifteenday__",  // 近15天的链接
                "onemonth" => "__link_onemonth__",  // 近一个月的链接
                "state_all" => "__link_refund__",  // 全部状态的链接
                "state_ing" => "__link_refund__",  // 进行中状态的链接
                "state_success" => "__link_refund__",  // 成功状态的链接
                "state_fail" => "__link_refund__",  // 失败状态的链接

            ],

            "data" => [
                [
                    "create_time" => "2014-11-19 12:12:03",   // 创建时间
                    "deal_type"   => "充值",   // 交易类型
                    "deal_details" => "3775552 <br> 订单号：45955399",  // 交易详情
                    "deal_money"  => "+7.00",   // 交易金额
                    "deal_state" => "成功"    // 交易状态
                ],
                [
                    "create_time" => "2014-11-19 12:12:03",   // 创建时间
                    "deal_type"   => "饿了么外卖",   // 交易类型
                    "deal_details" => "神速便当 <br> 订单号：12560523614499832",  // 交易详情
                    "deal_money"  => "-7.00",   // 交易金额
                    "deal_state" => "成功"    // 交易状态
                ],
                [
                    "create_time" => "2014-11-19 12:12:03",   // 创建时间
                    "deal_type"   => "充值",   // 交易类型
                    "deal_details" => "3775552 <br> 订单号：45955399",  // 交易详情
                    "deal_money"  => "+7.00",   // 交易金额
                    "deal_state" => "成功"    // 交易状态
                ],
                [
                    "create_time" => "2014-11-19 12:12:03",   // 创建时间
                    "deal_type"   => "饿了么外卖",   // 交易类型
                    "deal_details" => "神速便当 <br> 订单号：12560523614499832",  // 交易详情
                    "deal_money"  => "-7.00",   // 交易金额
                    "deal_state" => "成功"    // 交易状态
                ],
                [
                    "create_time" => "2014-11-19 12:12:03",   // 创建时间
                    "deal_type"   => "充值",   // 交易类型
                    "deal_details" => "3775552 <br> 订单号：45955399",  // 交易详情
                    "deal_money"  => "+7.00",   // 交易金额
                    "deal_state" => "成功"    // 交易状态
                ],
                [
                    "create_time" => "2014-11-19 12:12:03",   // 创建时间
                    "deal_type"   => "饿了么外卖",   // 交易类型
                    "deal_details" => "神速便当 <br> 订单号：12560523614499832",  // 交易详情
                    "deal_money"  => "-7.00",   // 交易金额
                    "deal_state" => "成功"    // 交易状态
                ]
            ]
        ],
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ]
    ];

    return View::make("template.personal.personal_details")->with($data);
});

Route::get("/personal_my_site", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ],

        "deliver_address" => [  // 送餐地址
            "sites" => [
                0 => [
                    "address_details"  => "ddddd",      // 送餐详细地址
                    "deliver_phone"    => "123232132",      // 送餐联系电话
                    "spare_phone"      => "12321323" ,              // 备用电话
                    "address_state"    => "0",      // 是否是默认地址 0 是默认地址 1不是默认地址
                    "edit_address"     => "http://baidu.com",      // 编辑地址的链接 (不用ajax  →_→)
                    "delete_address"   => "http://baidu.com",      // 删除地址的链接
                    "set_default"      => "http://baidu.com" ,     // 设为默认的地址
                ],
                1 => [
                    "address_details"  => "ddddd",      // 送餐详细地址
                    "deliver_phone"    => "123232132",      // 送餐联系电话
                    "spare_phone"      => "12321323" ,              // 备用电话
                    "address_state"    => "1",      // 是否是默认地址 0 是默认地址 1不是默认地址
                    "edit_address"     => "http://baidu.com",      // 编辑地址的链接 (不用ajax  →_→)
                    "delete_address"   => "http://baidu.com",      // 删除地址的链接
                    "set_default"      => "http://baidu.com"  ,    // 设为默认的地址
                ]
            ],
            "form_address_details"        => "asdasd" ,      // 表单中填入的送餐详细地址
            "form_deliver_phone"          => "123123" ,      // 表单中填入的手机号码
            "form_deliver_spare_phone"    => "12323"        // 表单中填入的备用号码
        ]
    ];

    return View::make("template.personal.personal_my_site")->with($data);
});

Route::get("/personal_recent_month", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ],
        "recent_month" => [
            "deal_count" => "11",
            "deal" => [
                [
                    "shop_id" => "111123",
                    "deal_id" => "123",
                    "deal_statue" => "3",
                    "same_again" => "##",
                    "deal_is_retrun" => "1",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "0",
                    "deal_satisfied" => "0",
                    "good" => [
                        [
                            "goods_id" => "111123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "111123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "2"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "红烧肉",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ],
                [
                    "shop_id" => "123",
                    "deal_id" => "123",
                    "deal_statue" => "0",
                    "same_again" => "##",
                    "deal_is_retrun" => "0",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "75分钟",
                    "deal_satisfied" => "0",
                    "good" => [
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "减减减",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ],
                [
                    "shop_id" => "123",
                    "deal_id" => "123",
                    "deal_statue" => "1",
                    "same_again" => "##",
                    "deal_is_retrun" => "1",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "5分钟",
                    "deal_satisfied" => "0",
                    "good" => [
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "红烧肉",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ],
                [
                    "shop_id" => "123",
                    "deal_id" => "123",
                    "deal_statue" => "2",
                    "same_again" => "##",
                    "deal_is_retrun" => "1",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "5分钟",
                    "deal_satisfied" => "1",
                    "good" => [
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "红烧肉",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ]
            ]
        ]
    ];

    return View::make("template.personal.personal_recent_month")->with($data);
});

Route::get("/personal_return", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ],
        "return" => [
            "deal_count" => "11",
            "deal" => [
                [
                    "shop_id" => "111123",
                    "deal_id" => "123",
                    "deal_statue" => "3",
                    "same_again" => "##",
                    "deal_is_retrun" => "1",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "0",
                    "deal_satisfied" => "0",
                    "good" => [
                        [
                            "goods_id" => "111123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "111123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "2"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "红烧肉",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ],
                [
                    "shop_id" => "123",
                    "deal_id" => "123",
                    "deal_statue" => "0",
                    "same_again" => "##",
                    "deal_is_retrun" => "0",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "75分钟",
                    "deal_satisfied" => "0",
                    "good" => [
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "减减减",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ],
                [
                    "shop_id" => "123",
                    "deal_id" => "123",
                    "deal_statue" => "1",
                    "same_again" => "##",
                    "deal_is_retrun" => "1",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "5分钟",
                    "deal_satisfied" => "0",
                    "good" => [
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "红烧肉",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ],
                [
                    "shop_id" => "123",
                    "deal_id" => "123",
                    "deal_statue" => "2",
                    "same_again" => "##",
                    "deal_is_retrun" => "1",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "5分钟",
                    "deal_satisfied" => "1",
                    "good" => [
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "红烧肉",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ]
            ]
        ]
    ];

    return View::make("template.personal.personal_return")->with($data);
});

Route::get("/personal_secure", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ]
    ];

    return View::make("template.personal.personal_secure")->with($data);
});

Route::get("/personal_uncomment", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ],
        "uncomment" => [
            "deal_count" => "11",
            "deal" => [
                [
                    "shop_id" => "111123",
                    "deal_id" => "123",
                    "deal_statue" => "3",
                    "same_again" => "##",
                    "deal_is_retrun" => "1",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "0",
                    "deal_satisfied" => "0",
                    "good" => [
                        [
                            "goods_id" => "111123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "111123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "2"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "红烧肉",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ],
                [
                    "shop_id" => "123",
                    "deal_id" => "123",
                    "deal_statue" => "0",
                    "same_again" => "##",
                    "deal_is_retrun" => "0",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "75分钟",
                    "deal_satisfied" => "0",
                    "good" => [
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "减减减",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ],
                [
                    "shop_id" => "123",
                    "deal_id" => "123",
                    "deal_statue" => "1",
                    "same_again" => "##",
                    "deal_is_retrun" => "1",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "5分钟",
                    "deal_satisfied" => "0",
                    "good" => [
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "红烧肉",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ],
                [
                    "shop_id" => "123",
                    "deal_id" => "123",
                    "deal_statue" => "2",
                    "same_again" => "##",
                    "deal_is_retrun" => "1",
                    "deal_return" => "##",
                    "deal_is_pre" => "1",
                    "deal_pre_time" => "2014-11-17 11:45:00",
                    "deal_again" => "##",
                    "shop_name" => "臭脚丫",
                    "deal_number" => "1234567345678",
                    "deal_time" => "2014-11-18 11:11:27",
                    "deal_phone" => "15340525659 15340525659",
                    "deliver_address" => "邮电大学太极操场西6门",
                    "deliver_phone" => "18716625394",
                    "deliver_remark" => "吃吃吃！",
                    "deal_speed" => "5分钟",
                    "deal_satisfied" => "1",
                    "good" => [
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ],
                        [
                            "goods_id" => "123",
                            "goods_name" => "红烧肉",
                            "goods_value" => "12",
                            "goods_amount" => "1",
                            "goods_total" => "12",
                            "good_atisfied" => "0"
                        ]
                    ],
                    "others" => [
                        [
                            "item_name" => "红烧肉",
                            "item_value" => "-5",
                            "item_amount" => "1",
                            "item_total" => "-5"
                        ]
                    ],
                    "total" => "19"
                ]
            ]
        ]
    ];

    return View::make("template.personal.personal_uncomment")->with($data);
});

Route::get("/personal_verify_email", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ]
    ];

    return View::make("template.personal.personal_verify_email")->with($data);
});

Route::get("/personal_verify_phone", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details")       // 收支明细
        ]
    ];

    return View::make("template.personal.personal_verify_phone")->with($data);
});

Route::get("/personal_change_phone", function(){
    $data = [
        "userbar" => [
            "url" => [
                "my_place" => "这里是地址",
                "switch_palce" => "##",
                "logo" => "123" ,                         // 网站主页地址
                "mobile" => "123",                 // 跳转到下载手机APP的地址
                "my_ticket" => "123",                 // 我的饿单的地址
                "my_gift"  => "123",                // 礼品中心地址
                "feedback" => "123",                // 反馈留言地址
                "shop_chart" => "123",                // 购物车地址
                "user_mail" => "123",                // 用户提醒的地址
                "personal" => "123",                // 个人中心地址
                "my_collection" => "123",               // 我的收藏地址
                "my_secure" => "123",              // 安全设置的地址
                "loginout" => "123",              // 退出登录的地址
                "switch_place" => "123"                  // 切换当前地址的地址
            ]
        ],
        "sidebar" => [  // 左侧栏地址
            "personal_center" => url("/personal_center"),  // 个人中心的地址
            "personal_recent_month" => url("personal_recent_month"), // 最近一个月的地址
            "personal_after_month" => url("personal_after_month") , // 一个月之前
            "personal_uncomment" => url("personal_uncomment") ,  // 未点评的订单
            "personal_return" => url("personal_return"),     // 退单中的订单
            "personal_collection_shop" => url("personal_collection_shop"),// 我收藏的餐厅的地址
            "personal_collection_goods" => url("personal_collection_goods"), // 我收藏的商品的地址
            "personal_my_site" => url("personal_my_site") ,  // 我的地址
            "personal_change_password" => url("personal_change_password"), // 修改密码
            "personal_secure"=> url("personal_secure"),        // 安全设置
            "personal_details" => url("personal_details"),       // 收支明细
            "personal_change_phone" => url("personal_change_phone")
        ]
    ];
    return View::make("template.personal.personal_change_phone")->with($data);
});


Route::get('/userBarSearch', function(){
    $data = [
        "success" => "true", // 成功返回true, 失败返回false
        "state"   => 200,  // HTTP 状态码
        "nextSrc" => "",  // 登录成功后的跳转地址
        "errMsg"  => "",  // 如果出现错误, 错误信息就出现在这, 如果没有, 那内容为空.
        "no"      => 0,  // 错误号 ,错误号就出现在这, 如果没有, 那内容为空.
        "data"    => [
            [
                "goods_category" => "美食", // 商品种类
                "shop_result" => [
                    [
                        "goods_name" => "小包才肉汤", // 商品名称
                        "goods_id" => "",             // 商品的id
                        "shop_name" => "XXX商店",    // 商家名称(如果是本店搜索, 这个为空)
                        "goods_value" => "16",        // 商品价格
                        "goods_url" => "",          // 跳转到这个商家的某个商品 (商品定位采用hash路径表示, 页面中id元素可以用hash来进行定位, 后端只需将对应的id拼接到相应的路径中去)
                        "img_url" => "",            // 商家logo地址 , 如果是种类是商家的话
                    ]
                ]
            ]
        ]
    ];


    return Response::json($data);
});

Route::get("/userBarCart", function(){
    $data = [
        "success" => "true"  ,                              // 成功
        "state"  => 200     ,                               // HTTP 状态码
        "errMsg"  => ""    ,                                // 如果出现错误, 错误信息就出现在这, 如果没有, 那内容为空.
        "no"      => 0      ,                               // 错误号 ,错误号就出现在这, 如果没有, 那内容为空.
        "data" => [
            "url" => [
                "shop_url" => "商店URL"   ,                         // 点击商家, 跳转到相应的商家页面
            ],
            "shop_name" => "商店名称"     ,                         // "商店名称"
            "all_value" => "16"   ,                         // 商品总价格
            "goods" => [
                [
                    "good_name" => "泡椒鸡胗煲仔饭",       // 名称
                    "good_value" => "8",                   // 价格
                    "good_count" => "1"                    // 数量
                ],
                [
                    "good_name" => "泡椒鸡-=仔饭",       // 名称
                    "good_value" => "222",                   // 价格
                    "good_count" => "12"                    // 数量
                ]
            ],
            "shop_state" => "0"  ,                          // 0 是可以付款买外卖, 1 是由于某种原因, 买不了外卖
            "state_msg" => ""  ,                            // 为啥买不了, 如果能买, 就位空
        ]
    ];

    return Response::json($data);

});


Route::get("/userBarMsg", function(){
    $data = [
        "success" => "true"  ,                              // 成功
        "state"  => 200     ,                               // HTTP 状态码
        "errMsg"  => ""    ,                                // 如果出现错误, 错误信息就出现在这, 如果没有, 那内容为空.
        "no"      => 0      ,                               // 错误号 ,错误号就出现在这, 如果没有, 那内容为空.
        "data" => []
    ];

    return Response::json($data);

});

Route::post("/ajax_collection_shop", function(){
    $data = [
        "success" => "true"  ,                              // 成功
        "state"  => 200     ,                               // HTTP 状态码
        "errMsg"  => ""    ,                                // 如果出现错误, 错误信息就出现在这, 如果没有, 那内容为空.
        "no"      => 0      ,                               // 错误号 ,错误号就出现在这, 如果没有, 那内容为空.
        "data" => []
    ];

    return Response::json($data);
});

Route::post("/ajax_change_phone", function(){
    $data = [
        "success" => "true",                              // 成功
        "state"  => 200,                               // HTTP 状态码
        "errMsg"  => "",                                // 如果出现错误, 错误信息就出现在这, 如果没有, 那内容为空.
        "no"      => 0,                               // 错误号 ,错误号就出现在这, 如果没有, 那内容为空.
        "data" => []
    ];

    return Response::json($data);
});

Route::post("/ajax_change_password", function(){
    $data = [
        "success" => "true",                              // 成功
        "state"  => 200,                               // HTTP 状态码
        "errMsg"  => "",                                // 如果出现错误, 错误信息就出现在这, 如果没有, 那内容为空.
        "no"      => 0,                               // 错误号 ,错误号就出现在这, 如果没有, 那内容为空.
        "data" => []
    ];

    return Response::json($data);
});

