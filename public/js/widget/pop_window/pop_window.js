define([ "jquery" ], function() {
    //ajax
    function ajaxGetConmments() {
        $.get("/goods_comments", function(res) {
            if ("object" != typeof res) try {
                res = $.parseJSON(res);
            } catch (err) {
                return void alert("服务器数据错误");
            }
            //请求成功后
            "true" == res.success ? showConmments(res.nextSrc ? res : res) : res.errMsg && alert(res.errMsg);
        });
    }
    //ajax获取成功后的操作 将数据填进dom中
    function showConmments(data) {
        //保存商品名称
        data.good_name = goodInfo.goodName;
        //获取模板填数据
        var temp = _.template($("#drawer-temp").html())(data);
        //渲染
        $(".pop_inner").html(temp);
    }
    //收藏商品ajax
    function collectAjax(data) {
        $.post("/collect", data, function(res) {
            if ("object" != typeof res) try {
                res = $.parseJSON(res);
            } catch (err) {
                return alert("服务器数据错误"), void $(".pop_window .u-favor").toggleClass("on");
            }
            if ("true" == res.success) {
                var itemFavor = $(".rst-aside-dish-item").eq(0).clone(!0);
                itemFavor.attr({
                    "data-good-id": goodInfo.goodId,
                    "data-shop-id": goodInfo.shopId
                }), //设置id
                itemFavor.find(".food_name").text(goodInfo.goodName), itemFavor.find(".symbol-rmb").text(goodInfo.goodPrice), 
                listsWrapper.find(".rst-aside-dish-item").eq(0).before(itemFavor);
            } else res.errMsg && alert(res.errMsg);
        });
    }
    //取消收藏商品ajax
    function delCollectAjax(data) {
        $.post("/delCollect", data, function(res) {
            if ("object" != typeof res) try {
                res = $.parseJSON(res);
            } catch (err) {
                return alert("服务器数据错误"), void $(".pop_window .u-favor").toggleClass("on");
            }
            "true" == res.success ? listsWrapper.find(".rst-aside-dish-item").each(function(i, $ele) {
                $ele = $($ele), $ele.attr("data-good-id") == data.goodId && $ele.attr("data-shop-id") == data.shopId && $ele.find(".food_name").text() == data.goodName && $ele.remove();
            }) : res.errMsg && alert(res.errMsg);
        });
    }
    console.log("pop windows loaded");
    /*
	 *@include "左侧评论打开与关闭"
	 *@include "ajax获取评论并显示出来" 
     *@include "收藏"
	*/
    //跟踪侧边栏商品信息
    var goodInfo = {
        goodName: "",
        //名称
        goodId: "",
        //商品id
        goodPrice: "",
        //价格
        shopId: $(".pop_window .pop_inner").attr("data-shop-id")
    }, $popWindow = $(".pop_window"), $windowMask = $(".u-mask");
    //打开左侧框
    $(".js-open-pop-window").on("click", function() {
        var $this = $(this);
        $popWindow.css("left", "0px"), $windowMask.show();
        var data = {
            good_id: $this.parents(".js-get-good-id").attr("data-good_id")
        };
        goodInfo.goodId = data.good_id, goodInfo.goodName = $this.parents(".menu_sec_status").siblings(".menu_sec_info").find(".menu_sec_desc").text(), 
        goodInfo.goodPrice = $this.parents(".menu_sec_status").siblings(".menu_sec_action").find(".symbol-rmb").text(), 
        ajaxGetConmments(data);
    }), //关闭左侧框
    $(document).on("click", ".js-close-pop-window, .u-mask", function() {
        $popWindow.css("left", "-400px"), $windowMask.hide();
    });
    /*---------------------------------------------
     *          商品收藏
     *---------------------------------------------
    */
    var listsWrapper = $(".rst-aside-menu-list");
    //列表
    //收藏商品
    $(".pop_window").on("click", ".u-favor", function() {
        var $this = $(this);
        //感应
        $this.toggleClass("on"), $this.hasClass("on") ? collectAjax(goodInfo) : delCollectAjax(goodInfo);
    }), /*------------------------------------
    *           有内容的评价显示控件(待定)
    *-------------------------------------
    */
    $(".pop_window").on("click", "#btn-check", function() {});
});