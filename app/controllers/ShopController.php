<?php

/**
 * 商户相关信息控制器
 *
 * index($shop_id) 	商家菜单页
 */

class ShopController extends BaseController {

	/**
	 * 商家菜单页
	 * 对应API：API/shop/Blade商家菜单页
	 * @param $shop_id 商家ID
	 */
	public function index($shop_id){
		$output = array();
		$output['top_bar'] = $this->getTopbar($shop_id);
		$output['goods_category']['data']['goods_category'] = $this->getGoodCategory($shop_id);
		$output['category']['data']['calssfy_sec'] = $this->getCategory($shop_id);
		$output['announcement']['data'] = $this->getAnnouncement($shop_id);
		$output['best_seller']['data'] = $this->getBestSeller($shop_id);	// 本周热卖

		var_dump($output);
		return View::make('test')->with('output', '------------------');
	}

	/**
	 * 功能：商家菜单页top_bar
	 * 模块：前台
	 * 对应API：API/shop/商家菜单页
	 */
	public function getTopbar($shop_id){
		if( Auth::check() ){
			$front_user = Auth::user();
			$shop = Shop::find($shop_id);
		} else{
			return '用户还没有登录';
		}

#TODO：前端给出用户的经纬度
		$front_user->x = 29.5387440000;
		$front_user->y = 106.6098690000;
			
		$top_bar = array(
			'url' => array(),
			'data' => array()
		);														
		$top_bar['url']['return_back'] = '';					// 返回主页的地址
		$top_bar['url']['shop_url']    = 'shop/'.$shop_id;			// 当前商家的地址
		$top_bar['url']['comment_url'] = 'shop/'.$shop_id.'/comment';// 商家评论页的地址
		$top_bar['url']['menu_url']    = 'shop/'.$shop_id;			// 商家菜单的地址
		$top_bar['url']['photo_url']   = 'shop/'.$shop_id.'/photo';	// 美食墙的地址
		$top_bar['url']['message_url'] = 'shop/'.$shop_id.'/message';// 商家留言的地址
		$top_bar['data']['shop_id']    	   = $shop_id;					// 商家ID
#TODO：place_id不需要
		$top_bar['data']['shop_logo'] 	   = $shop->pic;			// 商家的logo图片地址
		$top_bar['data']['shop_name'] 	   = $shop->name;			// 商家名称
		$top_bar['data']['shop_type'] 	   = $shop->type;			// 商家类型,逗号分隔的字符串
		$Level = $this->getLevel($shop);
		$top_bar['data']['shop_level'] 	   = $Level['thing_level'];	// 总共10个等级
		$top_bar['data']['shop_total'] 	   = $Level['thing_total'];	// 总评价
		$top_bar['data']['comment_count']  = $Level['comment_count'];// 评论人数
		$top_bar['data']['shop_statement'] = $shop->intro; 			// 商家简介
		$top_bar['data']['shop_time'] 	   = $shop->operation_time;	// 营业时间，字符串表示
		$top_bar['data']['shop_address']   = $shop->address;		// 商家地址
		$top_bar['data']['deliver_begin']  = $shop->begin_time;		// 送餐开始时间
		$xy = Geohash::find($shop_id);
		$top_bar['data']['shop_distance']  = $this->GetDistance($xy->x, $xy->y, $front_user->x, $front_user->y); // 人与店铺的距离(米)
		$top_bar['data']['price_begin']    = $shop->begin_price;	// 起送价
		$top_bar['data']['is_collected']   = in_array($shop_id, $front_user->collectShop->lists('shop_id'))?true:false;	// 是否被收藏了
#TODO：右上角的送货速度，董天成添加这个API
		$top_bar['data']['interval'] = $shop->interval;				// 送餐速度

		return $top_bar;
	}

	/**
	 * 功能：商家菜单页美食分类，商品的分类和活动是一起的，不过活动还是单独列一张表出来的
	 * 模块：前台
	 * 对应API：API/shop/商家菜单页/美食分类
	 */
	public function getGoodCategory($shop_id){
		$category = array();
		$shop = Shop::find($shop_id);

		$categories = $shop->groups->all();
		foreach($categories as $group){
			$one = array();
			$one['classify_name']      	= $group->name;									// 类别名称
			$one['classify_id']		   	= $group->id;									// 类别id
			$one['classify_count']     	= Menu::where('shop_id', $shop_id)->where('group_id', $group->id)->count(); // 类别中商品的数量
			$one['isActivity']			= $group->activity_id==0?'false':'true';		// 是不是活动
			$one['activity_statement']	= $group->activity_id==0?'':Activity::find($group->activity_id)->intro;
			array_push($category, $one);	
		}
		return $category;
	}

	/**
	 * 获取某个店铺分类的内容
	 * 模块：前台
	 * 对应API：API/shop/商家菜单页/分类内容
	 */
	public function getCategory($shop_id){
		$result = array();

		$shop = Shop::find($shop_id);
		$categories = $shop->groups->all();
		foreach($categories as $group){
			$one = array();

			$one['calssify_name'] = $group->name;
			$one['classify_id'] = $group->id;
			$one['classify_icon'] = $group->icon;

			if($group->activity_id == 0 ){
				$one['activity_ads'] = array();
			} else{
				$act = Activity::find($group->activity_id);
				$one['activity_ads']['activity_name'] = $act->name;
				$one['activity_ads']['activity_statement'] = $act->intro;
			}

			$goods = Menu::where('shop_id', $shop_id)->where('group_id', $group->id)->get();
			$classify_images = array();
			$classify_goods = array();
			foreach($goods as $good){
				$onegood = array();				

				if($good->pic == NULL){
					echo '没有';
					$onegood['goods_id']       = $good->id;				// 商品id
					$onegood['goods_name']     = $good->title;			// 商品名称
					$Level                     = $this->getLevel($good);		
					$onegood['goods_level']    = $Level['thing_total'];	// 商品等级
					$onegood['goods_price']    = $good->price;			// 商品价格
					$onegood['goods_icon']     = '';					// 没有就没有嘛
					$onegood['goods_original'] = $good->original_price;	// 如果是促销就显示原价
					array_push($classify_images, $onegood);
				}else{
					echo '有图片';
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
			$one['classify_goods'] = $classify_goods;
			array_push($result, $one);
		}
		return $result;
	}

	/**
	 * 获取某餐厅的公告
	 * @param  $shop_id 
	 * @return array
	 */
	public function getAnnouncement($shop_id){
		$data = array();
		$shop = Shop::find($shop_id);

		$data['announce_content'] = $shop->announcement;
		$data['start_price'] = $shop->begin_price;
		$data['activities'] = array();

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
	 * @return array
	 */
	public function getBestSeller($shop_id){
		$data = array();

		$shop = Shop::find($shop_id);
		$menus = $shop->menus()->get()->sortByDesc('sold_week')->take(5);
		foreach($menus as $menu){
			$one = array();
			$one['goods_id'] = $menu->id;
			$one['goods_name'] = $menu->title;
			$Level = $this->getLevel($menu);
			$one['goods_level'] = $Level['thing_level'];
			$one['comment_count'] = $Level['comment_count'];
			$one['goods_price'] = $menu->price;
			$one['shop_state'] = $menu->state == 1?'true':'false';
			array_push($data, $one);
		}
		var_dump($data);
	}

	/**
	 * 计算某个店铺评分的各个等级的
	 *
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
		
		$result['thing_level'] = $thing_level;
		$result['comment_count'] = array_sum($thing_level);
		if($result['comment_count'] == 0){
			$result['thing_total'] = 0;
		}else{
			$result['thing_total'] = round( ($thing->comments()->sum('value')) / $result['comment_count'], 1);// 保留一位小数
		}
		return $result;
	}

    /**
     * 计算两个坐标之间的距离
     * @param 显示店铺的横纵坐标，然后是用户的横纵坐标
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

}
