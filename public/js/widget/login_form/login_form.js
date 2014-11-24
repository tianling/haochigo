define([ "jquery" ], function($) {
    //表单验证     
    function checkLogin(data) {
        //normal err tip
        var $errPwd = $divUserPwd.find(".u-error-tip"), $errUserName = $divUserName.find(".u-error-tip"), $errAuth = $divAuth1.find(".u-error-tip");
        if ("normal" == loginWay) {
            //用户名没有输入
            if (data.user_email.length < 1) return $errUserName.show(), !1;
            //密码没有输入
            if ($errUserName.hide(), data.user_psw.length < 1) return $errPwd.show(), !1;
            //没有输入验证码
            if ($errPwd.hide(), 4 != data.user_auth.length) return $errAuth.show(), !1;
            $errAuth.hide();
        } else if ("mobile" == loginWay) {
            //电话号码没有输入
            if (!/^[\d]{11}$/.test(data.user_email)) return $divUserTel.find(".u-error-tip").show(), 
            !1;
            //没有输入验证码
            if (data.user_auth.length < 1) return $divAuth2.find(".u-error-tip").show(), !1;
        }
        return !0;
    }
    //ajax
    function ajaxForm(data) {
        $.ajax({
            url: "/login",
            type: "post",
            dataType: "json",
            data: data,
            success: function(res) {
                if (typeof res != object) try {
                    res = $.parseJSON(res);
                } catch (err) {
                    alert("服务器异常，稍后再试");
                }
                "true" == res.success ? location.href = res.nextSrc : res.no && res.no >= 1 && res.no <= 4;
            }
        });
    }
    //登陆模块
    /*
     * @inlude "切换登陆方式"
     * @inlude "验证表单"
     * @include "ajax 登陆"
    */
    //切换登陆方式
    //记录以哪种方式登陆(默认以正常方式登陆)
    var loginWay = "normal", $switchMobile = $("#switch-mobile"), $switchNormal = $("#switch-normal"), $mobileLoginW = $(".js-mobile-wapper"), $normalLoginW = $(".js-normal-wapper");
    //$switchMobile  ==> $mobileLoginW
    //switchNormal   ==> $normalLoginW
    //切换到mobile
    $switchMobile.on("click", function() {
        $(this).hide(), $switchNormal.show(), $mobileLoginW.show(), $normalLoginW.hide(), 
        loginWay = "mobile", //隐藏所有错误提示
        $(".u-error-tip").hide();
    }), //切换到normal
    $switchNormal.on("click", function() {
        $(this).hide(), $switchMobile.show(), $normalLoginW.show(), $mobileLoginW.hide(), 
        loginWay = "normal", //隐藏所有错误提示
        $(".u-error-tip").hide();
    });
    var $divUserName = $("#login-user-name"), $divUserPwd = $("#login-user-pwd"), $divUserTel = $("#login-user-mobile"), $divAuth1 = $("#login-user-auth1"), $divAuth2 = $("#login-user-auth2");
    //表单提交
    $("#login-form").on("submit", function() {
        var data = {
            user_psw: $divUserPwd.find("input").val(),
            //密码
            user_remember: function() {
                return 1 == $("#auto-login")[0].checked ? !0 : !1;
            }(),
            //记住密码自动登录
            user_email: function() {
                return "normal" == loginWay ? $divUserName.find("input").val() : "mobile" == loginWay ? $divUserTel.find("input").val() : void 0;
            }(),
            //登陆用户名 || 邮箱||电话号码
            user_auth: function() {
                return "normal" == loginWay ? $divAuth1.find("input").val() : "mobile" == loginWay ? $divAuth2.find("input").val() : void 0;
            }()
        };
        return checkLogin(data) ? (ajaxForm(data), !1) : !1;
    });
});