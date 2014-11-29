define([ "jquery", "underscore", "shop_cart/shop_cart" ], function($, _, cart) {
    //var _tpl = _.template($('#tpl-rst-dish-item').html());
    //$.ajax({
    //    url: '/whereistheAPI',
    //    type: 'POST',
    //    data: {},
    //    success: function(res){
    //        if(res.success == 'true'){
    //            $('.rst-aside-menu-list').html(_tpl({
    //                data: res.data
    //            }));
    //        }else{
    //            //TODO fail operation
    //        }
    //    }
    //});
    $("#favor_food").on("click", ".add_btn", function(e) {
        var pnt = $(e.target).parents(".r_d_a"), id = pnt.data("good_id"), shop_id = pnt.data("shop_id");
        cart.add(id, shop_id);
    }), console.log("goods_collection loaded");
});