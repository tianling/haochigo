define([ "jquery" ], function($) {
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
    function changeItemNum(e) {
        var t, self = $(this), dad = self.parent(), grandPa = self.parent().parent(), num = dad.find(".set_num_in"), val = parseInt(num.val());
        if (//--
        t = -1 !== e.target.className.indexOf("d_btn") ? val > 0 ? val - 1 : val : val + 1, 
        0 == t) {
            grandPa.remove();
            var itemTotal = $(".basket_list li").length;
            0 == itemTotal ? ($("#cartScroll").html('<p class="rcart-empty">篮子是空的</p>'), $(".rcart-info").remove()) : $("#cartTotalItems").html(itemTotal), 
            $cartUp.animate({
                top: -$cartUp.height() + "px"
            });
        }
        num.val(t), cart.refresh();
    }
    var $cartUp = $("#cartScroll");
    $(".aside-icon-cart").on("click", toggleCartScroll), //{
    //     itemId: 123,
    //     price: 10,
    //     count: 2,
    //     title: "平菇牛肉小份",
    //     domLi: null/$('xxx')
    // }
    Cart.prototype.find = function(id) {
        "object" == typeof id && (id = id.id);
        for (var i = 0, len = this.itemList.length; len > i; i++) if (this.itemList[i].id === id) return this.itemList[i];
        return !1;
    }, /**
      * [add 增加商品]
      * @param {[type]} itemId [description]
      * 返回 true 表示已经有这个 item, 返回数字表示成功
      */
    Cart.prototype.add = function(item) {
        return this.find(item.id) ? !1 : (this.itemList.push(item), ture);
    }, Cart.prototype.del = function(id) {
        "object" == typeof id && (id = id.id);
        for (var i = 0, len = this.itemList.length; len > i; i++) if (this.itemList[i].id === id) return this.itemList.splice(i, 1);
        return !1;
    }, Cart.prototype.getTotalPrice = function() {
        var total = 0;
        return this.itemList.forEach(function(item) {
            total += parseInt(item.price);
        }), total;
    }, Cart.prototype.refresh = function() {
        return this.totalPrice = this.getTotalPrice(), this.totalNum = this.itemList.length, 
        {
            totalPrice: this.totalPrice,
            totalNum: this.totalNum
        };
    }, Cart.prototype.empty = function() {
        this.itemList = [];
    };
    var cart = new Cart();
    $(".d_btn, .i_btn").on("click", changeItemNum), $(".rcart-d-del").on("click", function() {
        var self = $(this);
        self.parent().remove();
        var itemTotal = $(".basket_list li").length;
        0 == itemTotal ? ($("#cartScroll").html('<p class="rcart-empty">篮子是空的</p>'), $(".rcart-info").remove()) : $("#cartTotalItems").html(itemTotal), 
        cart.refresh(), $cartUp.animate({
            top: -$cartUp.height() + "px"
        });
    }), $(".rcart-clear").on("click", function() {
        $("#cartScroll").html('<p class="rcart-empty">篮子是空的</p>'), $(".rcart-info").remove(), 
        $cartUp.animate({
            top: -$cartUp.height() + "px"
        }), cart.empty();
    }), console.log("shop cart loaded");
});