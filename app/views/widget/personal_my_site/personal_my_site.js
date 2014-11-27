define(['jquery'], function($){
	console.log("personal my site loaded");
	$.fn.serializeObject = function(){
		var o = {};
		var a = this.serializeArray();

		$.each(a, function(){
			if( o[ this.name ] != undefined){
				if(! o[ this.name ].push){
					o[ this.name ] = [o[this.name]];
				}
				o[this.name].push( this.value || "")
			}
			else{
				o[this.name] = this.value || "";
			}
		});
		return o;
	};

	$("#order_form").on('submit', function(ev){
		var address_details = $("#address_details"),
			deliver_phone = $("#deliver_phone"),
			checkPlace = /\w+/,
			checkPhone = /\d{11}/,
			flag = true;

		if(! checkPlace.test(address_details.val())){
			address_details.parent().find(".error_box").show();
			address_details.addClass("error");
			flag = false;
		}
		if(! checkPhone.test(deliver_phone.val())){
			deliver_phone.parent().find(".error_box").show();
			deliver_phone.addClass("error");
			flag = false;
		}

		if(! flag){
			return false;
		}
	});


});