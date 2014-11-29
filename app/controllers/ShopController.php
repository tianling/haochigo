<?php

/**
 * 店铺相关信息
 *
 * index($shop_id)							商家主页
 * shopComments($shop_id)					商家评论页
 *
 *
 * addMenu()								添加菜单
 * cancelShop()								取消收藏某个商家
 * collectShop()							收藏某个店铺
 * getAnnouncement($shop_id)				获取某个店铺的公告
 * getBestSeller($shop_id)					获取某个店铺的本周热卖
 * getCategory($shop_id)					获取店铺分类的具体内容
 * getDistance($lat1, $lng1, $lat2, $lng2)	计算两个坐标之间的举例
 * getGoodCategory($shop_id)				获取店铺的分类信息
 * getGoodComment()							获取某个商品的评论
 * getLevel($thing)							获取店铺/菜单的评价统计信息
 * getMap($shop_id)							获取地图信息
 * getMyCollect($shop_id)					获取用户在该店铺内的收藏的商品
 * getShopComments($shop_id)				获取店铺所有的评价
 * getShopInfo($shop_id)					获取店铺的基本信息
 * getTopbar($shop_id)						获取顶部栏的一些地址数据
 * getUserBar()								获取userbar上面的一些地址数据
 */

/**
 * TODO
 * 未完成的部分有：
 * 位置地图shop_marp
 * 购物车
 * 评论切换分页
 */
class ShopController extends BaseController {

	/**
	 * 商家菜单页
	 */
	public function index($shop_id){
		$data = array();

		$data['collect'] = $this->getMyCollect($shop_id);								// 获取用户在该店铺内的收藏的商品
		$data['userbar']['url'] = $this->getUserBar();
		$data['top_bar']                          = $this->getTopbar($shop_id);			// 获取顶部栏信息
		$data['good_category']['data']            = $this->getGoodCategory($shop_id);	// 获取美食分类
		$data['category']['data']['classify_sec'] = $this->getCategory($shop_id);		// 获取分类内容
		$data['announcement']['data']             = $this->getAnnouncement($shop_id);	// 获取餐厅公告
		$data['best_seller']              = $this->getBestSeller($shop_id);				// 获取本周热卖
#TODO：地图地址未完成
		$data['shop_map']['data']      = $this->getMap($shop_id);						// 地图地址
		return View::make("template.shop.shop")->with($data);
	}

	/**
	 * 商家评论页
	 */
#TODO：未做分页功能
	public function shopComments($shop_id){
		$data = array();
		$data['userbar']['url'] = $this->getUserBar();
		$data['top_bar']        = $this->getTopbar($shop_id);
		$data['announcement']   = $this->getAnnouncement($shop_id);
		$data['good_category']  = $this->getGoodCategory($shop_id);		// 商家评论页要这个干嘛
		$data['category']       = $this->getCategory($shop_id);
		$data['shop_comments']  = $this->getShopComments($shop_id);

		return View::make("template.shop.shop_comment")->with($data);
	}

##
#	上面是页面：
#	下面是方法：
##

	/**
	 * 添加一个菜单
	 * 商铺
	 * 请求类型：POST
	 */
	public function addMenu(){
		if( !Auth::check() ){
			return Redirect::to('http://weibo.com');
		}

		$user = Auth::user();
		var_dump($user);
	}

	/**
	 * 取消收藏某个商家
	 *
	 * 测试完成
	 * 请求类型：POST
	 */
	public function cancelShop(){
		if( !Auth::check() ){
			return Redirect::to('http://weibo.com');
		}

		$user = Auth::user();
		$rules = array(
			'uid'     => 'required | integer',
			'shop_id' => 'required | integer',
		);
		$new_collect = array(
			'uid'     => $user->front_uid,
			'shop_id' => Input::get('shop_id'),
		);
		$v = Validator::make($new_collect, $rules);
		if( $v->fails() ){
			return Redirect::to('http://baidu.com');

			return Redirect::to('error')
				->with('user', Auth::user())
				->withErrors($v)
				->withInput();
		}

		if( CollectShop::where('shop_id', Input::get('shop_id'))->where('uid', $user->front_uid)->delete() ){
			$output            = array();
			$output['success'] = 'true';
			$output['state']   = 200;
			$output['nextSrc'] = '';
			$output['errMsg']  = '';
			$output['no']      = 0;
			Response::json($output);
		}
	}

	/**
	 * 收藏某个店铺
	 *
	 * 对应：API/shop/收藏商家
	 * 请求类型：POST
	 */
	public function collectShop(){
		if( !Auth::check() ){
			return Redirect::to('http://weibo.com');
		}

		$user = Auth::user();
		$rules = array(
			'uid'     => 'required | integer',
			'shop_id' => 'required | integer',
		);
		$new_collect = array(
			'uid'     => $user->front_uid,
			'shop_id' => Input::get('shop_id'),
			'uptime'  => time()
		);
		$v = Validator::make($new_collect, $rules);
		if( $v->fails() ){
			return Redirect::to('http://baidu.com');

			return Redirect::to('error')
				->with('user', Auth::user())
				->withErrors($v)
				->withInput();
		}

		$collect = new CollectShop($new_collect);
		if( $collect->save() ){
			$output            = array();
			$output['success'] = 'true';
			$output['state']   = 200;
			$output['nextSrc'] = '';
			$output['errMsg']  = '';
			$output['no']      = 0;
			$output['data']    = $this->getShopInfo(Input::get('shop_id'));
			//var_dump($output);
			Response::json($output);
		}
	}

	/**
	 * 获取某餐厅的公告
	 * @return array
	 */
	public function getAnnouncement($shop_id){
		$data = array();
		$shop = Shop::find($shop_id);
		
		$data['announce_content'] = $shop->announcement;
		$data['start_price']      = $shop->begin_price;
		$data['activities']       = array();

		$menus = $shop->groups()->get();
		foreach($menus as $menu){
			if($menu->activity_id != 0){
				$oneact = array();
				$act = Activity::find($menu->activity_id);

				$oneact['activity_name'] = $act->name;
				$oneact['activity_icon'] = $act->icon;

				array_push($data['activities'], $oneact);
			}
		}
		return $data;
	}

	/**
	 * 获取店铺的本周热卖,5个商品,销量前五的
	 */
	public function getBestSeller($shop_id){
		$data = array();

		$shop = Shop::find($shop_id);
		$menus = $shop->menus()->get()->sortByDesc('sold_week')->take(5);
		foreach($menus as $menu){
			$one                  = array();
			$one['goods_id']      = $menu->id;
			$one['goods_name']    = $menu->title;
			$Level                = $this->getLevel($menu);
			$one['goods_level']   = round($Level['thing_total'] * 2);
			$one['comment_count'] = $Level['comment_count'];
			$one['goods_price']   = (float)$menu->price;
			$one['shop_id']		  = $menu->shop_id;
			$one['shop_state']    = $shop->state;
			$one['error_state']   = $menu->state;
			array_push($data, $one);
		}
		return $data;
	}

	/**
	 * 获取某个店铺分类的内容
	 */
	public function getCategory($shop_id){
		$result = array();

		$shop = Shop::find($shop_id);
		$categories = $shop->groups->all();
		foreach($categories as $group){
			$one = array();

			$one['classify_name'] = $group->name;
			$one['classify_id']   = $group->id;
			$one['classify_icon'] = $group->icon;

			if($group->activity_id == 0 ){
				$one['activity_ads']['activity_name'] = '';
				$one['activity_ads']['activity_statement'] = '';
			} else{
				$act = Activity::find($group->activity_id);
				$one['activity_ads']['activity_name'] = $act->name;
				$one['activity_ads']['activity_statement'] = $act->intro;
			}

			$goods           = Menu::where('shop_id', $shop_id)->where('group_id', $group->id)->get();
			$classify_images = array();
			$classify_goods  = array();
			foreach($goods as $good){
				$onegood = array();				

				if($good->pic == NULL){
					$onegood['goods_id']       = $good->id;				// 商品id
					$onegood['goods_name']     = $good->title;			// 商品名称
					$Level                     = $this->getLevel($good);		
					$onegood['goods_level']    = $Level['thing_total'];	// 商品等级
					$onegood['goods_price']    = (float)$good->price;	// 商品价格
					$onegood['goods_icon']     = '';					// 没有就没有嘛
					$onegood['goods_original'] = (float)$good->original_price;	// 如果是促销就显示原价
					$onegood['good_sails']	   = $good->sold_num;
					array_push($classify_images, $onegood);
				}else{
					$onegood['goods_id']       = $good->id;				// 商品id
					$onegood['goods_image']    = $good->icon; 			// 商品图片地址
					$onegood['goods_name']     = $good->title;			// 商品名称
					$Level                     = $this->getLevel($good);
					$onegood['goods_level']    = $Level['thing_total'];	// 商品等级
					$onegood['comment_count']  = $Level['comment_count'];// 投票人数
					$onegood['goods_sails']    = $good->sold_num;		// 商品销量(这里写的是总销量)
					$onegood['goods_price']    = (float)$good->price;	// 商品价格
					$onegood['goods_icon']     = $good->icon;			// 一些用户促销的图标
					$onegood['goods_original'] = (float)$good->original_price;	// 如果是促销，这个用于显示原价
					$onegood['good_sails']	   = $good->sold_num;
					array_push($classify_goods, $onegood);
				}
			}
			$one['classify_images'] = $classify_images;
			$one['classify_goods']  = $classify_goods;
			array_push($result, $one);
		}
		return $result;
	}

	/**
     * 计算两个坐标之间的距离
     * @param 显示店铺的横纵坐标，然后是用户的横纵坐标
     * @return int 单位是米
     */
    private function getDistance($lat1, $lng1, $lat2, $lng2){
        $EARTH_RADIUS = 6378.137;
        $radLat1 = $lat1 * M_PI / 180.0;
        $radLat2 = $lat2 * M_PI / 180.0;
        $radLng1 = $lng1 * M_PI / 180.0;
        $radLng2 = $lng2 * M_PI / 180.0;
        $a = $radLat1 - $radLat2;  
        $b = $radLng2 - $radLng2; 
        $s = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)));  
        $s = $s * $EARTH_RADIUS;  
        $s = round($s * 10000);  
        return $s;  
    }

	/**
	 * 功能：商家菜单页美食分类，商品的分类和活动是一起的，不过活动还是单独列一张表出来的
	 */
	public function getGoodCategory($shop_id){
		$data = array();
		$shop = Shop::find($shop_id);
				
		$groups         = $shop->groups->all();
		$goods_category = array();
		$good_activity  = array();
		foreach($groups as $group){
			$one = array();
			if($group->activity_id == 0){		// 不是活动
				$one['classify_name']      = $group->name;
				$one['classify_name_abbr'] = $group->name_abbr;
				$one['classify_id']        = $group->id;
				$one['classify_count']     = Menu::where('shop_id', $shop_id)->where('group_id', $group->activity_id)->get()->count('shop_id');
				$one['classify_icon']      = $group->icon;
				array_push($goods_category, $one);
			}else{								// 是活动的
				$act                       = Activity::find($group->activity_id);
				$one['activity_name']      = $act->name;
				$one['activity_id']        = $act->aid;
				$one['activity_icon']      = $act->icon;
				$one['activity_statement'] = $act->intro;
				array_push($good_activity, $one);
			}
		}
		$data['goods_category'] = $goods_category;
		$data['good_activity']  = $good_activity;
		return $data;
	}

	/**
	 * API/shop/获取一个商品的评论
	 */
	public function getGoodComment(){
		$good_id = Input::get('goods_id');
		$menu = Menu::find($good_id);
		$comments = $menu->comments;

		if( $comments != NULL){
			$output = array();
			$output['success'] = 'true';
			$output['state']   = 200;
			$output['nextSrc'] = '';
			$output['errMsg']  = '';
			$output['no']      = 0;
			$Level = $this->getLevel($menu);
			$output['data']['shop_level']    = $Level['thing_level'];
			$output['data']['shop_total']    = $Level['thing_total'];
			$output['data']['comment_total'] = $Level['thing_total'];
			$output['data']['comment_body']  = array();

			foreach($comments as $comment){
				$one = array();
				$one['comment_person']  = FrontUser::find($comment->front_uid)->nickname;
				$one['comment_date']    = $comment->time;
				$one['comment_level']   = $comment->value;
				$one['comment_content'] = $comment->content;
				array_push($output['data']['comment_body'], $one);
			}
			Response::json($output);
		}else{
			return Redirect::to('http://baidu.com');
		}
	}

	/**
	 * 计算某个店铺评分的各个等级的
	 * @param  $thing 某个店铺或者某个商品
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
	 * 获取地图图片
	 */
	public function getMap($shop_id){
		$xy = Geohash::find($shop_id);
#TODO：前端给出用户的经纬度		
		$user_x   = 39.9812386;
		$user_y   = 116.3068369;
		$distance = $this->getDistance($xy->x, $xy->y, $user_x, $user_y);
		$data = array(
			'map_url'  => '',
			'distance' => $distance
		);
		return $data;
	}

	/**
	 * 获取该用户在该店铺内的收藏的商品
	 * 默认只显示5个，多的直接去掉
	 * @return [type] [description]
	 */
	public function getMyCollect($shop_id){
		$data = array();
		if( !Auth::check() ){
			return $data;
		}

		$user = Auth::user();
		$allCollects = $user->collectMenu;
		
		foreach($allCollects as $collect){
			$menu = Menu::find($collect->menu_id);
			if( ($menu->shop_id) == $shop_id ){
				array_push($data, array(
					'detail'  => $menu->title,
					'price'   => (float)$menu->price,
					'good_id' => $menu->id,
					'shop_id' => $menu->shop_id
				));
			}
		}
		return $data;
	}

	/**
	 * 获取店铺所有的评价，不分页
	 */
	public function getShopComments($shop_id){
		$data = array();
		$comments = Shop::find($shop_id)->comments;

		foreach($comments as $comment){
			$one  = array();
			$menu = Menu::find($comment->menu_id);
			$user = FrontUser::find($comment->front_uid);

			$one['good_name']  = $menu->title;
			$one['user_name']  = $user->nickname;
			$one['time']       = $comment->time;
			$one['content']    = $comment->content;
			$one['good_price'] = $menu->price;
#TODO：这里的评分居然是以图片形式的。。。
			$one['star_url'] = 'http://static11.elemecdn.com/forward/dist/img/restaurant/rst-sprites.b35686d3.png';

			array_push($data, $one);
		}
		return $data;
	}

	/**
	 * 获取某个店铺的基本信息
	 */
	public function getShopInfo($shop_id){
		$shop = Shop::find($shop_id);
		$info = array();
		
		$info['shop_id']        = $shop_id;					// 商家ID
#TODO：place_id不需要
		$info['shop_logo']      = $shop->pic;				// 商家的logo图片地址
		$info['shop_name']      = $shop->name;				// 商家名称
		$info['shop_type']      = $shop->type;				// 商家类型,逗号分隔的字符串
		$Level                  = $this->getLevel($shop);
		$info['shop_level']     = $Level['thing_level'];	// 总共10个等级
		$info['shop_total']     = $Level['thing_total'];	// 总评价
		$info['comment_count']  = $Level['comment_count'];	// 评论人数
		$info['shop_statement'] = $shop->intro; 			// 商家简介
		$info['shop_time']      = $shop->operation_time;	// 营业时间，字符串表示
		$info['shop_address']   = $shop->address;			// 商家地址
		$info['deliver_begin']  = $shop->begin_time;		// 送餐开始时间
		$xy                     = Geohash::find($shop_id);
#TODO：前端给出用户的经纬度		
		$user_x = 39.98123;
		$user_y = 116.3068369;
		$info['shop_distance']  = $this->getDistance($xy->x, $xy->y, $user_x, $user_y); // 人与店铺的距离(米)
		$info['price_begin']    = (float)$shop->deliver_price;		// 起送价
		if( Auth::check()){
			$front_user = Auth::user();
			$info['is_collected'] = in_array($shop_id, $front_user->collectShop->lists('shop_id'))?'true':'false';	// 是否被收藏了
		} else{
			$info['is_collected'] = 'false';
		}
#TODO：右上角的送货速度，董天成添加这个API
		$info['interval']       = $shop->interval;			// 送餐速度
#TODO：shop_remark API里两个不同的top_bar
		$info['shop_remark']    = '';
		return $info;
	}

	/**
	 * 功能：商家菜单页top_bar
	 * 模块：前台
	 *
	 * 测试完成
	 * 对应API：API/shop/商家菜单页
	 */
	public function getTopbar($shop_id){
		$shop = Shop::find($shop_id);		
		$top_bar = array(
			'url'  => array(),
			'data' => array()
		);
														
		$top_bar['url']['return_back'] = '';					// 返回主页的地址
		$top_bar['url']['shop_url']    = (string)$shop_id;		// 当前商家的地址
		$top_bar['url']['comment_url'] = $shop_id.'/comments';	// 商家评论页的地址
		$top_bar['url']['menu_url']    = (string)$shop_id;		// 商家菜单的地址
		$top_bar['url']['photo_url']   = $shop_id.'/photo';		// 美食墙的地址
		$top_bar['url']['message_url'] = $shop_id.'/message';	// 商家留言的地址
#TODO：在routes前端自己写的数据里有map_url选项，API里有两个不同的top_bar->url
		$top_bar['url']['map_url']	   = '地图地址';
		$top_bar['data'] = $this->getShopInfo($shop_id);
		return $top_bar;
	}

	/**
	 * userbar上面那一些列地址
	 */
	public function getUserBar(){
		$url = array(
				"my_place"      => "这里是地址",
				"switch_palce"  => "##",
				"logo"          => "http://localhost/haochigo/public",	// 网站主页地址
				"mobile"        => "123",                 				// 跳转到下载手机APP的地址
				"my_ticket"     => 'order',                 			// 我的饿单的地址
				"my_gift"       => 'gift',                				// 礼品中心地址
				"feedback"      => 'feedback',                			// 反馈留言地址
				"shop_chart"    => "cart",                				// 购物车地址
				"user_mail"     => "mail",                				// 用户提醒的地址
				"personal"      => "profile",                			// 个人中心地址
				"my_collection" => "profile/shop",               		// 我的收藏地址
				"my_secure"     => "profile/security",              	// 安全设置的地址
				"loginout"      => "loginout",              			// 退出登录的地址
				"switch_place"  => "switch_place"                  		// 切换当前地址的地址
		);
		return $url;
	}
}