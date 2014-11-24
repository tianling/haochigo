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
#TODO：美食分类这个API有问题呀，怎么会有两个data
		$output['goods_category']['data']['goods_category'] = $this->getCategory($shop_id);	// 美食分类
		$output['goods_category']['data']['good_activity']  = $this->getActivity($shop_id);	// 商家活动

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
		$top_bar['data']['shop_level'] 	   = $Level['shop_level'];	// 总共10个等级
		$top_bar['data']['shop_total'] 	   = $Level['shop_total'];	// 总评价
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
	 * 功能：商家菜单页美食分类
	 * 模块：前台
	 * 对应API：API/shop/商家菜单页
	 */
	public function getCategory($shop_id){
		if( Auth::check() ){
			$front_user = Auth::user();
			$shop = Shop::find($shop_id);
		} else{
			return '用户还没有登录';
		}

		$category = array();
		$categories = $shop->groups->all();
		foreach($categories as $group){
			$one = array();
			$one['classify_name']      = $group->name;									// 类别名称
			$one['classify_name_abbr'] = $group->name_abbr;								// 类别名称简写
			$one['classify_count']     = Menu::where('group_id', $group->id)->count(); 	// 类别中商品的数量
			$one['classify_icon']      = $group->icon;									// 类别图标
			array_push($category, $one);	
		}
		return $category;
	}

	/**
	 * 功能：获取商家支持的活动activity信息
	 * @return [type] [description]
	 */
	public function getActivity($shop_id){
		if( Auth::check() ){
			$front_user = Auth::user();
			$shop = Shop::find($shop_id);
		} else{
			return '用户还没有登录';
		}

		$activity = array();
		//$activities = $shop->

	}

	/**
	 * 计算某个店铺评分的各个等级的
	 *
	 * @param int $shop_id 店铺ID
	 * @return array(评论数，总评论数，总评价)
	 */
	private function getLevel($shop){
		$result = array();

		$shop_level = array();
		$shop_level['level_5'] = $shop->comments()->whereBetween('value', array(4.5, 5.0))->count('value');
		$shop_level['level_4'] = $shop->comments()->whereBetween('value', array(3.5, 4.0))->count('value');
		$shop_level['level_3'] = $shop->comments()->whereBetween('value', array(2.5, 3.0))->count('value');
		$shop_level['level_2'] = $shop->comments()->whereBetween('value', array(1.5, 2.0))->count('value');
		$shop_level['level_1'] = $shop->comments()->whereBetween('value', array(0.0, 1.0))->count('value');
		
		$result['shop_level'] = $shop_level;
		$result['comment_count'] = array_sum($shop_level);
		$result['shop_total'] = round( ($shop->comments()->sum('value')) / $result['comment_count'], 1);// 保留一位小数

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
