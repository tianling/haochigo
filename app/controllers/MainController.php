<?php

/**
 * 主页
 */
class MainController extends BaseController {

	public function index(){
		$data = array();

		$data['userbar']['url'] = array(
				"my_place"      => "这里是地址",
				"switch_palce"  => "##",
				"logo"          => "123" ,                         // 网站主页地址
				"mobile"        => "123",                 // 跳转到下载手机APP的地址
				"my_ticket"     => "123",                 // 我的饿单的地址
				"my_gift"       => "123",                // 礼品中心地址
				"feedback"      => "123",                // 反馈留言地址
				"shop_chart"    => "123",                // 购物车地址
				"user_mail"     => "123",                // 用户提醒的地址
				"personal"      => "123",                // 个人中心地址
				"my_collection" => "123",               // 我的收藏地址
				"my_secure"     => "123",              // 安全设置的地址
				"loginout"      => "123",              // 退出登录的地址
				"switch_place"  => "123"                  // 切换当前地址的地址
        );
		$data['pic_swap'] = array(
			array( 
				"image_url" => "http://gtms02.alicdn.com/tps/i2/TB1OK_uGXXXXXXwXVXXnLSnFXXX-880-70.png",
				"jump_url"  => "1231"
            ),
            array(
				"image_url" => "http://gtms02.alicdn.com/tps/i2/TB1OK_uGXXXXXXwXVXXnLSnFXXX-880-70.png",
				"jump_url"  => "1231231"
        	)
        );
		$data['side_bar']       = $this->getSideBar(); // 右边功能栏
		$data['my_store']       = $this->getMyStore(); // 我收藏的店铺
		$data['my_store_alert'] = ''; // 我的收藏点击按钮之后弹出的框
		$allStore               = $this->getShopList();
		$data['shop_list']      = $allStore['shop_list'];	// 餐厅列表
		$data['more_shop']      = $allStore['more_shop']; // 更多餐厅
		$data['add_image']['data'] = array(
				array(
					"image_url" => "###",
					"jump_url" => "##",
				),
				array(
					"image_url" => "###",
					"jump_url" => "##",
				),
				array(
					"image_url" => "###",
					"jump_url" => "##",
				),
				array(
					"image_url" => "###",
					"jump_url" => "##",
				),
				array(
					"image_url" => "###",
					"jump_url" => "##",
				)
        ); //5个广告图片
		

		//var_dump($data);

		return View::make('template.home.home')->with($data);
	}

	/**
	 * 获取顶部轮播的图片
	 */
#TODO：未完成
	public function getPicSwap(){
		return 'pic_swap';
	}

	/**
	 * 获取右边功能栏的基本信息
	 * @return [type] [description]
	 */
#TODO：未完成
	public function getSideBar(){
		return 'side_bar';
	}

	/**
	 * 获取我收藏的店铺
	 * @return 
	 */
	public function getMyStore(){
		if( Auth::check() ){
			$user = Auth::user();
		}else{
			Redirect::to('http://baidu.com');
		}

		$stores = CollectShop::where('uid', $user->front_uid)->orderBy('uptime', 'desc')->take(5)->lists('shop_id');

		$my_store         = array();
		$my_store['url']  = 'personal/collection/shop';
		$my_store['data'] = array();

		foreach($stores as $store){
			$onestore = array();
			
			$shop                           = Shop::find($store);
			$onestore['shop_id']            = $shop->id;
#TODO:place_id不需要
			$onestore['place_id']           = '123';					// ----------------------------------------后期可能是x和y
			$onestore['shop_url']           = 'shop/'.$shop->id;		 	// 点击跳转到相应商家
			$onestore['shop_logo']          = $shop->pic;		  	// 商家的logo图片地址
			$onestore['deliver_time']       = $shop->interval;	// 送货时间间隔
			$onestore['deliver_start']      = $shop->operation_time;	// ----------------------------没有开始时间，只有一个时间字符串
			$onestore['shop_name']          = $shop->name;			// 商家名称
			$onestore['shop_type']          = $shop->type;			// 商家类型，以逗号分隔的字符串---------------------------这个还是问一下
			$Level                          = $this->getLevel($shop);
			$onestore['shop_level']         = $Level['thing_total'];			// 商家评级
			$onestore['order_count']        = $shop->sold_num;		// 订单总量
			$onestore['is_opening']         = $shop->state;			// 营业状态
			$onestore['is_ready_for_order'] = $shop->reserve;// 是否接受预定

			array_push($my_store['data'], $onestore);
		}
		return $my_store;
	}

		/**
	 * 计算某个店铺评分的各个等级的
	 *
	 * @param  $thing 某个店铺或者某个商品
	 *
	 * 测试完成
	 * @return array(评论数，总评论数，总评价)
	 */
	public function getLevel($thing){
		$result = array();

		$thing_level = array();
		$thing_level['level_5'] = $thing->comments()->whereBetween('value', array(4.5, 5.0))->count('value');
		$thing_level['level_4'] = $thing->comments()->whereBetween('value', array(3.5, 4.0))->count('value');
		$thing_level['level_3'] = $thing->comments()->whereBetween('value', array(2.5, 3.0))->count('value');
		$thing_level['level_2'] = $thing->comments()->whereBetween('value', array(1.5, 2.0))->count('value');
		$thing_level['level_1'] = $thing->comments()->whereBetween('value', array(0.0, 1.0))->count('value');
		
		$result['thing_level']   = $thing_level;
		$result['comment_count'] = array_sum($thing_level);
		if($result['comment_count'] == 0){
			$result['thing_total'] = 0;
		}else{
			$result['thing_total'] = round( ($thing->comments()->sum('value')) / $result['comment_count'], 1);// 保留一位小数
		}
		return $result;

	}

	/**
	 * 获取餐厅列表
	 * 默认15个，多的在更多餐厅里面显示
	 * 
	 * @return [type] [description]
	 */
	public function getShopList(){
		if( Auth::check() ){
			$user = Auth::user();
		} else{
			Redirect::to('http://baidu.com');
		}

		$result = array(
			'shop_list' => array(),
			'more_shop' => array()
		);

		$result['shop_list']['data']          = array();
		$result['more_shop']['data']          = array();
		$result['shop_list']['data']['shops'] = array();

		# 首先获取所有的活动
		$result['shop_list']['data']['activity'] = array();
		$activity = Activity::all();

		foreach($activity as $act){
			$result['shop_list']['data']['activity'][(string)$act->aid] = $act->name;
		}

		$data['shops'] = array();
#TODO：由前端获取用户坐标
		$user_x = 39.9812385;
		$user_y = 116.3068369;

		$geohash   = new Geohash();
		$shopArray = $geohash->geohashGet($user_x, $user_y);
		$shops     = $shopArray['data'];
		$num       = 0; // 计数器，只15个

		foreach($shops as $oneshop){
			$onestore = array();
			$shop     = $oneshop['shopData'];

			$onestore['support_activity']        = explode(',', $shop->support_activity);		// 所有支持的活动id
			$onestore['isHot']                   = $shop->is_hot?'true':'false';								// 是否是热门餐厅
			$onestore['isOnline']                = $shop->is_online?'true':'false';						// 是否营业		
			$onestore['isSupportPay']            = in_array('1', explode(',', $shop->pay_method));	// 是否支持在线支付
			$onestore['shop_id']                 = $shop->id;											// 商家id
#TODO：place_id不需要
			$onestore['place_id']                = '不需要';									// -------------------位置经纬度和位置id后期再改数据库
			$onestore['shop_url']                = 'shop/'.$shop->id;									// 点击跳转到相应商家
			$onestore['shop_logo']               = $shop->pic;		  								// 商家的logo图片地址
			$onestore['deliver_time']            = $shop->interval;								// 送货时间间隔
			$onestore['deliver_start']           = $shop->begin_time;								// 送货开始时间
			$onestore['shop_name']               = $shop->name;										// 商家名称
			$onestore['shop_type']               = $shop->type;
			$Level                               = $this->getLevel($shop);
			$onestore['shop_level']              = $Level['thing_total'];										// 五分制
			$onestore['shop_announce']           = $shop->announcement;							// 商家公告
#TODO:模版里用的deliver_state_start
			$onestore['deliver_state_start']     = $shop->begin_price;
			$onestore['deliver_start_statement'] = $shop->begin_price;		// 起送价描述
			$onestore['shop_address']            = $shop->address;									// 商家地址
			$onestore['is_opening']              = $shop->state;										// 0是正在营业，1是打烊了，2是太忙了
			$onestore['is_ready_for_order']      = $shop->reserve;							// 是否接收预定
			$onestore['close_msg']               = $shop->close_msg;									// 关门信息
			$onestore['business_hours']          = $shop->operation_time;						// 营业时间
			$onestore['shop_summary']            = $shop->intro;									// 商家简介
			$onestore['order_count']             = $shop->sold_num;									// 订单数量
			$onestore['is_collected']            = in_array($shop->id, $user->collectShop->lists('shop_id'))?'true':'false';	// 是否被收藏了
#TODO：额外内容有什么用
			$onestore['additions']               = array();													// 额外的内容

			$num = $num + 1;
			if($num < 2){
				array_push($result['shop_list']['data']['shops'] , $onestore);
			}else{
				array_push($result['more_shop']['data'], $onestore);
			}
		}	
		return $result;
	}

	/**
	 * 5个广告图片
	 */
	public function addImage(){

	}
}
