define(['jquery'], function($){
	function Sizer(){
		this.data = {};
	}


	// 添加队列
	Sizer.prototype.add = function(value, label){
		var self = this;

		if(!self.data[label]){
			self.data[label] = [];
		}
		if($.isFunction(value)) return;

		self.data[label].push(value);
	}

	

});