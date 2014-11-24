require.config({
    baseUrl: "js/lib/",
    shim: {
        underscore: {
            exports: "_"
        }
    },
    paths: {
        product_image: "../widget/product_image",
        register_form: "../widget/register_form",
        login_form: "../widget/login_form",
        footer: "../widget/footer"
    }
}), // 加载项目所需的所有依赖项
define([ "footer/footer", "product_image/product_image", "register_form/register_form" ], function() {
    console.log("init");
});