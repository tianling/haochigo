<?php

/**
 * 商户相关信息控制器
 *
 * index($shop_id) 	商家菜单页
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
	 * 对应API：API/shop/Blade商家菜单页
	 * @param $shop_id 商家ID
	 */
	public function index($shop_id){
		$data = array();

		$data['userbar']['url'] = array("my_place" => "这里是地址",					// 这里的数据是前端写的，我把它复制到这儿来，获取该信息的函数应该写在用户系统里吧
				"switch_palce"  => "##",
				"logo"          => "123",       
				"mobile"        => "123",      
				"my_ticket"     => "123",     
				"my_gift"       => "123",  
				"feedback"      => "123",    
				"shop_chart"    => "123",
				"user_mail"     => "123",     
				"personal"      => "123",    
				"my_collection" => "123",  
				"my_secure"     => "123",   
				"loginout"      => "123",     
				"switch_place"  => "123"   
                );
		$data['top_bar']                          = $this->getTopbar($shop_id);			// 获取顶部栏信息
		$data['good_category']['data']            = $this->getGoodCategory($shop_id);	// 获取美食分类
		$data['category']['data']['classify_sec'] = $this->getCategory($shop_id);		// 获取分类内容
		$data['announcement']['data']             = $this->getAnnouncement($shop_id);	// 获取餐厅公告
		$data['best_seller']['data']              = $this->getBestSeller($shop_id);		// 获取本周热卖
#TODO：地图地址未完成
		$data['shop_map']['data']['map_url']      = '地图地址';							// 地图地址
		return View::make("template.shop.shop")->with($data);
	}

	/**
	 * 商家评论页
	 *
	 * @return blade
	 */
#TODO：未完成，分页功能
	public function shopComments($shop_id){
		$output                           = array();
		$output['top_bar']                = $this->getTopbar($shop_id);			// 获取顶部蓝信息
		$output['comment']['comment_all'] = $this->getCommentPage($shop_id);	// 获取商家评论页
		$output['coment_summary']         = $this->getCommentSummary;			// 总评价
	}

	/**
	 * 获取商家的总评价comment_summary
	 *
	 * 测试完成
	 */
	public function getCommentSummary($shop_id){
		$shop = Shop::find($shop_id);
		$data = array();

		$Level                 = $this->getLevel($shop);
		$data['shop_level']    = $Level['thing_level'];
		$data['shop_total']    = $Level['thing_total'];
		$data['comment_count'] = $Level['comment_count'];

		return $data;
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
		$top_bar['url']['shop_url']    = 'shop/'.$shop_id;			// 当前商家的地址
		$top_bar['url']['comment_url'] = 'shop/'.$shop_id.'/comment';// 商家评论页的地址
		$top_bar['url']['menu_url']    = 'shop/'.$shop_id;			// 商家菜单的地址
		$top_bar['url']['photo_url']   = 'shop/'.$shop_id.'/photo';	// 美食墙的地址
		$top_bar['url']['message_url'] = 'shop/'.$shop_id.'/message';// 商家留言的地址
#TODO：在routes前端自己写的数据里有map_url选项，API里有两个不同的top_bar->url
		$top_bar['url']['map_url']	   = '地图地址';
		$top_bar['data'] = $this->getShopInfo($shop_id);
		return $top_bar;
	}

	/**
	 * 获取某个店铺的基本信息
	 *
	 * 测试完成
	 * @return array
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
		$user_x = 29.5387440000;
		$user_y = 106.6098690000;
		$info['shop_distance']  = $this->GetDistance($xy->x, $xy->y, $user_x, $user_y); // 人与店铺的距离(米)
		$info['price_begin']    = $shop->begin_price;		// 起送价
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
	 * 功能：商家菜单页美食分类，商品的分类和活动是一起的，不过活动还是单独列一张表出来的
	 * 模块：前台
	 * 对应API：API/shop/商家菜单页/美食分类
	 *
	 * 测试完成
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
	 * 获取某个店铺分类的内容
	 * 模块：前台
	 *
	 * 测试完成
	 * 对应API：API/shop/商家菜单页/分类内容
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
					$onegood['goods_price']    = $good->price;			// 商品价格
					$onegood['goods_icon']     = '';					// 没有就没有嘛
					$onegood['goods_original'] = $good->original_price;	// 如果是促销就显示原价
					array_push($classify_images, $onegood);
				}else{
					$onegood['goods_id']       = $good->id;				// 商品id
					$onegood['goods_image']    = $good->icon; 			// 商品图片地址
					$onegood['goods_name']     = $good->title;			// 商品名称
					$Level                     = $this->getLevel($good);
					$onegood['goods_level']    = $Level['thing_total'];	// 商品等级
					$onegood['comment_count']  = $Level['comment_count'];// 投票人数
					$onegood['goods_sails']    = $good->sold_num;		// 商品销量(这里写的是总销量)
					$onegood['goods_price']    = $good->price;			// 商品价格
					$onegood['goods_icon']     = $good->icon;			// 一些用户促销的图标
					$onegood['goods_original'] = $good->original_price;	// 如果是促销，这个用于显示原价
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
	 * 获取某餐厅的公告
	 * @param  $shop_id 
	 *
	 * 测试完成
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
	 * @param  $shop_id
	 *
	 * 测试完成
	 * @return array
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
			$one['goods_level']   = $Level['thing_level'];
			$one['comment_count'] = $Level['comment_count'];
			$one['goods_price']   = $menu->price;
			$one['shop_state']    = $menu->state == 1?'true':'false';
			array_push($data, $one);
		}
		return $data;
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
	 * API/shop/获取一个商品的评论
	 *
	 * 请求类型：get
	 *
	 * 测试完成
	 * @return [type] [description]
	 */
	public function getGoodComment(){
		$good_id = Input::get('goods_id');
		$menu = Menu::find($good_id);
		$comments = $menu->comments;

		if( $comments != NULL){
			$output = array();
			$output['success'] = 'true';
			$output['state'] = 200;
			$output['nextSrc'] = '';
			$output['errMsg'] = '';
			$output['no'] = 0;
			$Level = $this->getLevel($menu);
			$output['data']['shop_level'] = $Level['thing_level'];
			$output['data']['shop_total'] = $Level['thing_total'];
			$output['data']['comment_total'] = $Level['thing_total'];
			$output['data']['comment_body'] = array();

			foreach($comments as $comment){
				$one = array();
				$one['comment_person'] = FrontUser::find($comment->front_uid)->nickname;
				$one['comment_date'] = $comment->time;
				$one['comment_level'] = $comment->value;
				$one['comment_content'] = $comment->content;
				array_push($output['data']['comment_body'], $one);
			}
			Response::json($output);
		}else{
			return Redirect::to('http://baidu.com');

		}
		
	}

    /**
     * 计算两个坐标之间的距离
     * @param 显示店铺的横纵坐标，然后是用户的横纵坐标
     *
     * 测试完成
     * @return int 单位是米
     */
    private function GetDistance($lat1, $lng1, $lat2, $lng2){
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
     * 对应API：API/shop/评论切换分页
     * 
     * @return ajax
     */
#TODO：未完成
    public function getCommentPage(){
    	$shop_id = Input::get('shop_id');
    	$page = Input::get('comment_pages');
    	$comment_all = array();

		$comments = Shop::find($shop_id)->comments()->paginate(3);
		$comment_all['comment_pages'] = $comments->getLastPage();

		$comments->getTo(2);

	
		echo $comments->getCurrentPage();		// 当前页
		echo $comments->getLastPage();			// 最后一页的页码
		echo $comments->getTotal();				// 总共的数量
		echo $comments->count();				// 本页的数量
		//echo $comments->getPerPage();
		var_dump($comments);
    }

    /**
     * 取消收藏商品
     *
     * 测试完成
     *
     * 对应API：API/shop/取消收藏商品
     * @return [type] [description]
     */
    public function cancelMenu(){
    	if( !Auth::check() ){
			return Redirect::to('http://weibo.com');
		}

		$user = Auth::user();
		$rules = array(
			'uid'   => 'required | integer',
			'goods_id' => 'required | integer'
		);
		$new_collect = array(
			'uid' => $user->front_uid,
			'goods_id'  => Input::get('goods_id')
		);
		$v = Validator::make($new_collect, $rules);
		if( $v->fails() ){
			return Redirect::to('http://baidu.com');

			return Redirect::to('error')
				->with('user', Auth::user())
				->withErrors($v)
				->withInput();
		}

		if( CollectMenu::where('menu_id', Input::get('goods_id'))->where('user_id', $user->front_uid)->delete() ){
			$output = array();
			$output['success'] = 'true';
			$output['state'] = 200;
			$output['nextSrc'] = '';
			$output['errMsg'] = '';
			$output['no'] = 0;
			Response::json($output);
		}
    }

	/**
	 * 取消收藏某个商家
	 *
	 * 对应API：API/shpo/取消收藏某个商家
	 *
	 * 测试完成
	 * 请求类型：POST
	 * @return array 执行状态
	 */
	public function cancelShop(){
		if( !Auth::check() ){
			return Redirect::to('http://weibo.com');
		}

		$user = Auth::user();
		$rules = array(
			'uid'   => 'required | integer',
			'shop_id' => 'required | integer',
		);
		$new_collect = array(
			'uid' => $user->front_uid,
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
			$output = array();
			$output['success'] = 'true';
			$output['state'] = 200;
			$output['nextSrc'] = '';
			$output['errMsg'] = '';
			$output['no'] = 0;
			Response::json($output);
		}
	}

	/**
	 * 收藏某个店铺
	 *
	 * 对应：API/shop/收藏商家
	 * 请求类型：POST
	 * 测试通过
	 * @return array 执行状态
	 */
	public function collectShop(){
		if( !Auth::check() ){
			return Redirect::to('http://weibo.com');
		}

		$user = Auth::user();
		$rules = array(
			'uid'   => 'required | integer',
			'shop_id' => 'required | integer',
		);
		$new_collect = array(
			'uid' => $user->front_uid,
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
			$output = array();
			$output['success'] = 'true';
			$output['state'] = 200;
			$output['nextSrc'] = '';
			$output['errMsg'] = '';
			$output['no'] = 0;
			$output['data']= $this->getShopInfo(Input::get('shop_id'));
			//var_dump($output);
			Response::json($output);
		}
	}
}
