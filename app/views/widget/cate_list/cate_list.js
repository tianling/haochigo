define(['jquery'], function(){
	console.log("cate list loaded");

	function delayTrigger(callback, params){
		var timer,
			flag = true;

		return function(ev){

			self = this;

			params = params || [];

			if(flag){
				flag = false;
				callback.apply(self, params);
			}
			if(timer){
				return ;
			}

			timer = setTimeout(function(){
				flag = true;
				timer = undefined;
			}, 30);
		}
	}

	function getListTop(list){
		var arr = [];

		list.each(function(index, value){
			arr.push($(this).offset());
		});
		return arr;
	}

	var CaculateDirection = (function(){
		var direction = 1,
			scrollTmp = 0;

		return function(scrollTop){
			if(scrollTop > scrollTmp){
				direction = 1;
			}
			else{
				direction = -1;
			}
			scrollTmp = scrollTop;

			return direction;
		}
	}());

	var d               = document,
		menu_toolbar    = $(".menu_toolbar"),
		menu_offset     = menu_toolbar.offset(),
		toolBar_toggle  = $(".toolBar_toggle"),
		drop_down_menu  = $(".drop_down_menu"),
		classify_sec    = $(".classify_sec"),
		sec_title       = $(".sec_title"),
		toolbar_text    = $(".toolbar_text").find("span"),
		scrollIndex     = 0,
		ready_tmp,               // 状态保存
		ready_status    = false; // 是否需要运行切换


	if($(window).scrollTop() >= menu_offset.top){
		menu_toolbar.css({
			"position" : "fixed",
			"top" : 0
		});
		toolBar_toggle.fadeIn(300);
	}

	toolBar_toggle.on('click', function(){
		drop_down_menu.toggle();
	});

	$(window).on('scroll', function(e){
		var scrollTop = $(window).scrollTop(),
			positionArr = getListTop(classify_sec),
			direction = CaculateDirection(scrollTop),
			isReady = scrollTop >= menu_offset.top, // 是否可以切换fixed
			isSwape = scrollIndex === swape_tmp,
			nextPosition, prevPosition,
			target;

		if(isReady != ready_tmp){
			ready_status = true;
			ready_tmp = isReady;
		}


		if(isReady && ready_status){
			menu_toolbar.css({
				"position" : "fixed",
				"top" : 0
			});
			toolBar_toggle.fadeIn(300);
			ready_status = false;
		}
		else if(!isReady && ready_status){
			menu_toolbar.css({
				"position" : "absolute",
				"top"    : "auto"
			});
			toolBar_toggle.fadeOut(300);
			ready_status = false;
		}


		if(isReady && direction === 1){
			if(scrollIndex + 1 >= positionArr.length) return;
			nextPosition = positionArr[scrollIndex+1];
			if(scrollTop + 10 > nextPosition.top){
				target = sec_title.eq(scrollIndex + 1).find("span").html();
				scrollIndex++;
				toolbar_text.html(target);
			}
		}
		else if(isReady && direction === -1){
			if(scrollIndex - 1 < 0) return;
			prevPosition = positionArr[scrollIndex];
			if(scrollTop + 10 < prevPosition.top){
				target = sec_title.eq(scrollIndex - 1).find('span').html();
				scrollIndex--;
				toolbar_text.html(target);
			}
		}
	});






});