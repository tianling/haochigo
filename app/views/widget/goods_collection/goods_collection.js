define(['jquery', 'underscore'], function($, _){
    var $ffood = $('#favor_food');
    var _tpl = _.template($('#tpl-rst-dish-item').html());
    $.ajax({
        url: '/whereistheAPI',
        type: 'POST',
        data: {},
        success: function(res){
            if(res.success == 'true'){
                $('.rst-aside-menu-list').html(_tpl({
                    data: res.data
                }));
            }else{
                //TODO fail operation
            }
        }
    });

    //DEL FUNC
//    $ffood.find('.rst-d-act-toggle').on('click', function(e){
//        var self = $(this);
//        var par = self.parent();
//        if(par.hasClass('ui_open')){
//            par.removeClass('ui_open');
//        }else{
//            $ffood.find('.ui_open').removeClass('ui_open');
//            par.addClass('ui_open');
//            self.after('<div class="rst-d-act-dropdown main_food_panel"><span class="helper">添加到以下菜品中</span></div>');
//        }
//    });
	console.log("goods_collection loaded");
});