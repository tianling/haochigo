define(['jquery', 'shop_cart/shop_cart'], function($, cart){
    $('#rec_food').on('click', '.add_btn', function(e){
        var pnt = $(e.target).parents('.r_d_a');
        var id = pnt.data('good_id'),
            shop_id = pnt.data('shop_id');
//alert(id+'|'+shop_id);
        cart.add(id, shop_id);
    });
	console.log("hot sails loaded");
});