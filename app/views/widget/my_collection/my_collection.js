define(['jquery'], function($){
	console.log("my collection loaded");

    var colArr = Array.prototype.slice.call($('.collection-row-book:has(.collection-row-book-close)').map(function(i, n){
        return $(n).data('shop_id');
    }));

    $('.collection-row-book-close, .more_shops-row-book .uncollect').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        var self = $(this);
        var shop_id = self.parent().data('shop_id');
        if(!shop_id)return;
        var place_id =  self.parent().data('place_id');
        removeFav({
            shop_id: shop_id,
            place_id: place_id
        });
    });

    $('.more_shops-row-book .collect').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        var self = $(this);
        var shop_id = self.parent().data('shop_id');
        if(!shop_id)return;
        var place_id =  self.parent().data('place_id');
        addFav({
            shop_id: shop_id,
            place_id: place_id
        });
    });

    function removeFav(opts){
        var shop_id = opts.shop_id,
            place_id = opts.place_id || 0;
        $.ajax({
            url: '##urlhere##',
            type: "POST",
            data: {
                shop_id: shop_id,
                place_id: place_id
            },
            beforeSend: function(){},
            success: function(res){
                if(res && res.success == 'true'){
                    var pos = colArr.indexOf();
                    if(pos === -1)return;

                    colArr.splice(pos, 1);
                    $('.collection-row-book[data-shop_id='+ shop_id + ']').empty().html('<div class="add"></div>').addClass('collection-row-none');
                }
            },
            error: function(){}
        });
    }

    function addFav(opts){
        var shop_id = opts.shop_id,
            place_id = opts.place_id || 0;
        $.ajax({
            url: '##urlhere##',
            type: "POST",
            data: {
                shop_id: shop_id,
                place_id: place_id
            },
            beforeSend: function(){},
            success: function(res){
                if(res && res.success == 'true'){
                     var data = res.data;
                     if(colArr.indexOf(data.shop_id) > -1)return;
                     colArr.push(data.shop_id);
                    $('.collection-row-none:first').html(wraper(data));
                }
            },
            error: function(){}
        });

        function wraper(d){
            return '<div class="collection-row-book" data-shop_id="' + d.shop_id +'">'
            + '<div class="collection-row-book-close"><i class="close"></i></div>'
            + '<div class="collection-row-book-left"><div class="logo">'
            + '<img src="http://localhost:8080/takeaway/public/' + d.shop_logo + '"></div>'
            + '<span title="平均送餐时间' + d.deliver_time + '分钟">' + d.deliver_time + '分钟</span></div>'
            + '<div class="collection-row-book-right"><div class="title"><p>' + d.shop_name + '</p></div>'
            + '<div class="style"><span>'+ d.shop_type +'</span></div><div class="remark">'
            + '<div class="star" title="餐厅评价：' + d.shop_level + '星" style="background-position: -1px ' + ( -334 + 15.5 * Math.ceil(d.shop_level * 2) ) + 'px;"></div>'
            + '<span>' + d.order_count + '订单</span></div></div></div>';
        }

    }
});