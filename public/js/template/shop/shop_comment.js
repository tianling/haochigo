require.config({
    baseUrl: "js/lib/",
    shim: {
        underscore: {
            exports: "_"
        }
    },
    paths: {
        shop: "../template/shop",
        userBar: "../widget/userBar",
        shop_cart: "../widget/shop_cart",
        shop_evaluate: "../widget/shop_evaluate",
        shop_comment: "../widget/shop_comment",
        shop_collect_bar: "../widget/shop_collect_bar"
    }
}), // 加载项目所需的所有依赖项
define([ "userBar/userBar", "shop_cart/shop_cart", "shop_evaluate/shop_evaluate", "shop_comment/shop_comment", "shop_collect_bar/shop_collect_bar" ], function() {
    console.log("init");
});