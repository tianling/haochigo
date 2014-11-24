require.config({
	baseUrl : "js/lib/",
	shim : {
		"underscore" : {
			exports : "_"
		}
	},
	paths : {
		shop : "../template/shop",
		userBar : "../widget/userBar",
		cate_category : "../widget/cate_category",
		cate_list   : "../widget/cate_list",
		goods_collection : "../widget/goods_collection",
		hot_sails : "../widget/hot_sails",
		restaurant_announcement : "../widget/restaurant_announcement",
		shop_details : "../widget/shop_details",
		shop_map : "../widget/shop_map",
		shop_cart : "../widget/shop_cart"

	}
});


// 加载项目所需的所有依赖项
define([
	"userBar/userBar",
	"cate_category/cate_category",
	"cate_list/cate_list",
	"goods_collection/goods_collection",
	"hot_sails/hot_sails",
	"restaurant_announcement/restaurant_announcement",
	"shop_details/shop_details",
	"shop_map/shop_map",
	"shop_cart/shop_cart"
], function($){
	console.log("init");
});

