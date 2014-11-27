define([ "jquery" ], function($) {
    //验证所填数据
    function checkRegister(data) {
        //normal err tip
        var $errPwd = $divUserPwd.find(".u-error-tip"), $errMobile = $divUserMobile.find(".u-error-tip"), $errRePwd = $div.UserRwd.find("u-error-tip"), $errAuth = $divAuth.find(".u-error-tip"), $errEmail = $divEmail.find(".u-error-tip"), regEmail = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+/, regAuth = / /, regTel = / /, regPwd = / /;
        //验证电话号码
        //验证电话号码
        //验证邮箱
        //验证验证密码
        //验证验证密码是否相同
        //验证码
        return regTel.test(data.user_phone) ? ($errMobile.hide(), regEmail.test(data.user_email) ? ($errEmail.hide(), 
        regPwd.test(data.user_psw) ? ($errPwd.hide(), data.user_psw != $divUserRePwd.find("input").val() ? ($errRePwd.show(), 
        !1) : ($errRePwd.hide(), regAuth.test(data.user_auth) ? ($errAuth.hide(), !0) : ($errAuth.show(), 
        !1))) : ($errPwd.show(), !1)) : ($errEmail.show(), !1)) : ($errMobile.show(), !1);
    }
    //ajax
    function ajaxForm(data) {
        $.ajax({
            url: "/register",
            type: "post",
            dataType: "json",
            data: data,
            success: function(res) {
                if (typeof res != object) try {
                    res = $.parseJSON(res);
                } catch (err) {
                    alert("服务器异常，稍后再试");
                }
                "true" == res.success ? res.nextSrc && (location.href = res.nextSrc) : res.no && res.Msg;
            }
        });
    }
    //注册表单
    /*
     *验证
     *ajax
     *点击验证码切换
    */
    //验证码点击切换
    $(".captcha-img").on("click", function() {
        $.get("/switch_auth", function(res) {
            if (typeof res != object) try {
                res = $.parseJSON(res);
            } catch (err) {
                return void alert("服务器数据异常，稍后再试");
            }
            res.success && res.nextSrc ? $(".captcha-img").attrs("src", res.nextSrc) : !res.success && res.errMsg && alert(res.errMsg);
        });
    });
    var $divUserMobile = $("#register-user-mobile"), $divUserPwd = $("#user-pwd"), $divUserRePwd = $("#user-re-pwd"), $divUserEmail = $("#register-user-email"), $divAuth = $("#register-user-auth");
    //提交表单
    $("#register-form").on("submit", function() {
        var data = {
            user_phone: $divUserMobile.find("input").val(),
            //电话号码
            user_psw: $divUserPwd.find("input").val(),
            //密码
            user_email: $divUserEmail.find("input").val(),
            //邮箱
            user_name: $divUserName.find("input").val(),
            //用户名
            user_auth: $divAuth.find("input").val()
        };
        return checkRegister(data) ? (ajaxForm(data), !1) : !1;
    });
});