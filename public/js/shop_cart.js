define([ "jquery", "underscore" ], function($, _) {
    function toggleCartScroll() {
        $cartUp.animate(parseInt($cartUp.css("top")) ? {
            top: "0px"
        } : {
            top: -$cartUp.height() + "px"
        });
    }
    /**
      * Cart Constructor
      * @param opts
      * @constructor
      */
    function Cart(opts) {
        for (var i in opts) this[i] = opts[i];
        //init
        this.itemList = [];
    }
    //实例化 cart
    function refreshCart() {
        var $totalLen = $("#cartTotalItems"), $totalPrice = $("#cartTotalPrice"), cartInfo = cart.refresh();
        $totalLen.html(cartInfo.totalNum), $totalPrice.html(cartInfo.totalPrice), 0 == cartInfo.totalPrice ? ($(".rcart-info").hide(), 
        $("#cartScroll").html('<p class="rcart-empty">篮子是空的</p>'), $(".aside-cart-btn").addClass("disabled").html("篮子是空的哦")) : ($(".rcart-info").show(), 
        $(".aside-cart-btn").removeClass("disabled").html("点击支付"));
    }
    function changeItemNum(e) {
        var self = $(e.target);
        if ("A" == self.context.tagName) {
            var t, dad = self.parent(), grandPa = self.parent().parent(), num = dad.find(".set_num_in"), val = parseInt(num.val()) || 0;
            -1 !== e.target.className.indexOf("d_btn") ? //--
            t = val > 0 ? val - 1 : val : -1 !== e.target.className.indexOf("i_btn") && (//++
            t = val + 1);
            var id = grandPa.data("good_id"), shop_id = grandPa.data("shop_id");
            return 0 >= t ? exports.del(id) : void $.ajax({
                url: "./cartSetCount",
                type: "post",
                data: {
                    good_id: id,
                    shop_id: shop_id,
                    count: t
                },
                success: function(res) {
                    "true" == res.success ? cart.find(id, function(item) {
                        item && (item.count = t, num.val(t), refreshCart(), fixScroll());
                    }) : alert("网络错误!");
                }
            });
        }
    }
    function clearCart() {
        $.ajax({
            url: "./cartClear",
            type: "post",
            data: {},
            success: function(res) {
                "true" == res.success ? (cart.empty(), refreshCart(), fixScroll()) : alert("网络错误!");
            }
        });
    }
    function fixScroll() {
        $cartUp.animate({
            top: -$cartUp.height() + "px"
        });
    }
    var $cartUp = $("#cartScroll");
    $(".aside-icon-cart").on("click", toggleCartScroll), //     {
    //          id: 123,
    //          price: 10,
    //          count: 2,
    //          title: "平菇牛肉小份",
    //          domLi: null/$('xxx')
    //     }
    Cart.prototype.find = function(id, callback) {
        "object" == typeof id && (id = id.id);
        for (var i = 0, len = this.itemList.length; len > i; i++) if (this.itemList[i].id == id) return callback && callback(this.itemList[i]), 
        this.itemList[i];
        return !1;
    }, /**
      * [add 增加商品]
      * @param {[type]} itemId [description]
      * 返回 true 表示已经有这个 item, 返回数字表示成功
      */
    Cart.prototype.add = function(item) {
        if (!this.find(item.id)) {
            this.itemList.push(item);
            var tpl = _.template($("#tpl-cart-item").html())({
                data: item
            });
            return $(".rcart-empty").length > 0 && $("#cartScroll").html('<h4 class="rcart-title">购物车<a class="rcart-clear basket_clear_btn">[清空]</a></h4><ul class="rcart-list basket_list"></ul>'), 
            $(".basket_list").append(tpl), refreshCart(), fixScroll(), !0;
        }
        return !1;
    }, Cart.prototype.setCount = function(id, callback) {
        var item = this.find(id);
        return item ? void callback(item) : callback(null);
    }, Cart.prototype.del = function(id) {
        "object" == typeof id && (id = id.id);
        for (var i = 0, len = this.itemList.length; len > i; i++) if (this.itemList[i].id == id) return this.itemList.splice(i, 1);
        return !1;
    }, Cart.prototype.getTotalPrice = function() {
        var total = 0;
        return this.itemList.forEach(function(item) {
            var count = item.count || 0;
            total += parseInt(item.price * count);
        }), total;
    }, Cart.prototype.getTotalCount = function() {
        var total = 0;
        return this.itemList.forEach(function(item) {
            var count = item.count || 0;
            total += parseInt(count);
        }), total;
    }, Cart.prototype.refresh = function() {
        return this.totalPrice = this.getTotalPrice(), this.totalNum = this.getTotalCount(), 
        {
            totalPrice: this.totalPrice,
            totalNum: this.totalNum
        };
    }, //todo for debug 显示状态用的
    Cart.prototype.state = function() {
        console.log(this.itemList);
    }, Cart.prototype.empty = function() {
        this.itemList = [];
    };
    var cart = new Cart();
    $("#cartScroll").on("click", ".d_btn, .i_btn", changeItemNum), $("#cartScroll").on("keyup", ".set_num_in", function(e) {
        var self = $(e.target), pnt = self.parents(".rcart-dish"), id = pnt.data("good_id"), shop_id = pnt.data("shop_id"), count = parseInt(self.val());
        return count ? void exports.setCount(id, count, shop_id) : !1;
    }), $("#cartScroll").on("click", ".rcart-d-del", function(e) {
        var self = $(e.target), pnt = self.parent(), id = pnt.data("good_id"), shop_id = pnt.data("shop_id");
        $.ajax({
            url: "./cartDel",
            type: "post",
            data: {
                good_id: id,
                shop_id: shop_id
            },
            success: function(res) {
                "true" == res.success ? (cart.del(pnt.data("good_id")), pnt.remove(), refreshCart(), 
                fixScroll()) : alert("网络错误!");
            }
        });
    }), $("#cartScroll").on("click", ".basket_clear_btn", clearCart);
    var exports = {
        add: function(id, shop_id) {
            $.ajax({
                url: "./cartAdd",
                type: "post",
                data: {
                    good_id: id,
                    shop_id: shop_id
                },
                beforeSend: function() {},
                success: function(res) {
                    if ("true" == res.success) {
                        var data = res.data;
                        $("#cartTotalItems").html(data.cart_count), $("#cartTotalPrice").html(data.cart_all), 
                        cart.add({
                            id: data.addedItem.goods_id,
                            price: data.addedItem.goods_price,
                            count: data.addedItem.goods_count,
                            title: data.addedItem.goods_name,
                            shop_id: data.shop_id,
                            domLi: null
                        });
                    } else alert(res.info);
                }
            }), refreshCart();
        },
        del: function(id, shop_id) {
            $.ajax({
                url: "./cartDel",
                type: "post",
                data: {
                    good_id: id,
                    shop_id: shop_id
                },
                success: function(res) {
                    if ("true" == res.success) {
                        var deled = cart.del(id);
                        return deled ? ($('.rcart-dish[data-good_id="' + id + '"]').remove(), refreshCart(), 
                        fixScroll(), deled) : !1;
                    }
                    alert("网络错误!");
                }
            });
        },
        setCount: function(id, count, shop_id) {
            return 0 >= count ? exports.del(id, shop_id) : void $.ajax({
                url: "./cartSetCount",
                type: "post",
                data: {
                    good_id: id,
                    shop_id: shop_id,
                    count: count
                },
                success: function(res) {
                    "true" == res.success ? cart.find(id, function(item) {
                        item && (item.count = count, refreshCart(), fixScroll());
                    }) : alert("网络错误!");
                }
            });
        },
        empty: clearCart,
        getState: function() {
            cart.state();
        }
    };
    //TODO devel for DEBUG
    return window.cart = exports, exports;
});