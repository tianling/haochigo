define(['jquery'], function($) {
	console.log("personal center loaded");
	$(".recent_order").on('click', function(){
		$(".tab_header li").each(function(index, value){
			$(value).removeClass("active");
		});
		$(this).addClass("active");
		$('.recent_ticket').show();
		$(".recent_month").hide();
	});

	$(".recent_deal").on('click', function(){
		$(".tab_header li").each(function(index, value){
			$(value).removeClass("active");
		});
		$(this).addClass("active");
		$(".recent_ticket").hide();
		$(".recent_month").show();
	});
});