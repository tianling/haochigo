define(['jquery', "tools/Sizer"], function($, Sizer){
	var drop_button = $(".drop_button"),
		drop_list = $(".drop_list"),
		activitiesBtn = $('.activities-btn'),
		shops_func = $('.shops_func'),
		choice_click = $(".choice_click");

	drop_button.on('click', function(e){
		drop_list.toggle();
	});

	function getAllData(){
		var target = $(".shop_container .more_shops-row-book");

		var result = {
			support_activity : [],
			isHot : [],
			isOnline : [],
			isSupportPay : [],
			flavor : []
		};

		target.each(function(index, value){
			var ta = target.eq(index),
				shop_id = ta.data('shop_id'),
				data = {};
			data[shop_id] = ta.data("support_activity");
			result.support_activity.push(data);
			Sizer.add("support_activity", data);

			data[shop_id] = ta.data('ishot');
			result.isHot.push(data);
			data[shop_id] = ta.data('isonline');
			result.isOnline.push(data);
			data[shop_id] = ta.data("issupportpay");
			result.isSupportPay.push(data);
			data[shop_id] = ta.data("flavor");
			result.flavor.push(data);
		});

		return result;
	}

	choice_click.on('click', 'b', function(ev){

		var checked = $(this).parent().find('input')[0].checked;

		if(checked){
			$(this).parent().find('input')[0].checked = false;
		}
		else {
			$(this).parent().find('input')[0].checked = true;
		}

		var checkedBtn = $(".choice_click"),
			checkedArray = [];

		checkedBtn.each(function(index, value){
			if(value.checked){
				checkedArray.push(value);
			}
		});
		console.log(checkedArray);



	});



	drop_list.on('click', "li", function(ev){
		var target = ev.currentTarget,
			type = target.innerHTML;

		drop_list.toggle();
	});


});