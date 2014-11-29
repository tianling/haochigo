define(["jquery"], function($){
	console.log("shop collection bar loaded");
/*
 *  @include "侧边栏收藏按钮"
*/
	$(".js-fav-shop").on("click", function(){
		var $this             = $(this),
		      $favorBar      = $this.find(".glyph"),   //红心
		      $favorStatus = $this.find(".status");  //状态

		 //商家信息
		 var shopInfo  = {
		 	'shop_id'         : "",
		 	"shop_name"  : ""
		 };

		//按钮变红 || 取消变红
		$favorBar.toggleClass("on");
                        
		if(  $favorBar. hasClass("on") ){   //如果收藏
			$favorStatus.text("已收藏");

			shopFavorAjax( shopInfo );
		}else{                                               //如果取消收藏
			$favorStatus.text("收藏餐厅");

			delShopFavor( shopInfo );
		}
	});

	//收藏ajax
	function shopFavorAjax( data ){
		$.post("/shopFavor", data, function(res){
			if( typeof res != "object"){
				try{
					res = $.parseJSON(res);
				}catch(err){
					alert("服务器数据错误！！！");
				}
			}
                                    
                                    //失败的话
			if( res.success != "true" ){
				if(res.errMsg){
					alert(res.errMsg);
				}else{
					alert("收藏失败!");
				}

				$favorBar.toggleClass("on");   //取消变红
				$favorStatus.text("收藏餐厅");  //文字变回
			}
		});
	}

	//取消收藏ajax
	function delShopFavor( data){
		$.post("/delShopFavor", data, function(res){
			if( typeof res != "object"){
				try{
					res = $.parseJSON(res);
				}catch(err){
					alert("服务器数据错误！！！");
				}
			}
                                    
                                    //失败的话
			if( res.success != "true" ){
				if(res.errMsg){
					alert(res.errMsg);
				}else{
					alert("取消收藏失败!");
				}

				$favorBar.toggleClass("on");   //取消 不 变红
				$favorStatus.text("已收藏");  //文字变回
			}
		});
	} 
});