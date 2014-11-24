 define(['jquery'], function($){
     var $cartUp = $('#cartScroll');
     $('.aside-icon-cart').on('click', toggleCartScroll);
     function toggleCartScroll(e){
        if(!parseInt($cartUp.css('top'))){
            $cartUp.animate({top: -$cartUp.height() + 'px'});
        }else{
            $cartUp.animate({top: '0px'});
        }
     }

     /**
      * Cart Constructor
      * @param opts
      * @constructor
      */
     function Cart(opts){
         for(var i in opts){
             this[i] = opts[i];
         }
         //init
         this.itemList = [];

     }
     //{
     //     itemId: 123,
     //     price: 10,
     //     count: 2,
     //     title: "平菇牛肉小份",
     //     domLi: null/$('xxx')
     // }

     Cart.prototype.find = function(id){
         if(typeof id == 'object')
             id = id.id;
         for(var i = 0, len = this.itemList.length; i < len; i++ ){
             if(this.itemList[i].id === id) return this.itemList[i];
         }
         return false;
     }
     /**
      * [add 增加商品]
      * @param {[type]} itemId [description]
      * 返回 true 表示已经有这个 item, 返回数字表示成功
      */
     Cart.prototype.add = function(item){
         if(!this.find(item.id)){
             this.itemList.push(item);
             return ture;
         }
         return false;
     }

     Cart.prototype.del = function(id){
         if(typeof id == 'object')
             id = id.id;
         for(var i = 0, len = this.itemList.length; i < len; i++ ){
             if(this.itemList[i].id === id) return this.itemList.splice(i, 1);
         }
         return false;
     }

     Cart.prototype.getTotalPrice = function(){
         var total = 0;
         this.itemList.forEach(function(item){
             total += parseInt(item.price);
         });
         return total;
     }

     Cart.prototype.refresh = function(){
        this.totalPrice = this.getTotalPrice();
        this.totalNum = this.itemList.length;
         return {
             totalPrice: this.totalPrice,
             totalNum: this.totalNum
        };
     }

     Cart.prototype.empty = function(){
         this.itemList = [];
     }

     var cart = new Cart();
     function addItem(id){
         cart.add(id);

     }

     $('.d_btn, .i_btn').on('click', changeItemNum);

     function changeItemNum(e){
         var self = $(this);
         var dad = self.parent();
         var grandPa = self.parent().parent();
         var num = dad.find('.set_num_in');
         var val = parseInt(num.val());
         var t;
         if(e.target.className.indexOf('d_btn') !== -1){ //--
             t = val > 0 ? val - 1 : val;
         }else{ //++
             t = val + 1;
         }
         if(t == 0){
             grandPa.remove();
             var itemTotal = $('.basket_list li').length;
             if(itemTotal == 0){
                 $('#cartScroll').html('<p class="rcart-empty">篮子是空的</p>');
                 $('.rcart-info').remove();
             }else{
                 $('#cartTotalItems').html(itemTotal);
             }
             $cartUp.animate({top: -$cartUp.height() + 'px'});
         }
         num.val(t);
         cart.refresh();
     }

     $('.rcart-d-del').on('click', function(){
         var self = $(this);
         self.parent().remove();
         var itemTotal = $('.basket_list li').length;
         if(itemTotal == 0){
             $('#cartScroll').html('<p class="rcart-empty">篮子是空的</p>');
             $('.rcart-info').remove();
         }else{
             $('#cartTotalItems').html(itemTotal);
         }
         cart.refresh();
         $cartUp.animate({top: -$cartUp.height() + 'px'});
     });

     $('.rcart-clear').on('click', function(){
         $('#cartScroll').html('<p class="rcart-empty">篮子是空的</p>');
         $('.rcart-info').remove();
         $cartUp.animate({top: -$cartUp.height() + 'px'});
         cart.empty();
     });
     console.log("shop cart loaded");

 });