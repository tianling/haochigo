require.config({
    baseUrl: "js/lib/",
    shim: {
        underscore: {
            exports: "_"
        }
    },
    paths: {
        product_image: "../widget/product_image",
        login_form: "../widget/login_form",
        footer: "../widget/footer"
    }
}), // 加载项目所需的所有依赖项
define([ "footer/footer", "product_image/product_image", "login_form" ], function() {
    console.log("init");
});