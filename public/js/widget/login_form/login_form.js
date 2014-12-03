define([ "jquery" ], function($) {
    //验证码ajax请求
    function getAuth(data) {
        $.post("/switch_auth", data, function(res) {
            if (res = {}, typeof res != object) try {
                res = $.parseJSON(res);
            } catch (err) {
                return void alert("服务器数据异常，稍后再试");
            }
            if (res.success && res.nextSrc) if (res.nextSrc) $(".captcha-img").attrs("src", res.nextSrc); else {
                alert("短信已经发送，请注意接收验证码"), //计时禁止连续发送30秒
                $smsBtn.attr("disabled", "disabled");
                var count = 30, orginText = $smsBtn.text(), authTimer = setInterval(function() {
                    $smsBtn.text(count-- + "秒后可再发送"), 1 > count && ($smsBtn.text(orginText).removeAttr("disabled"), 
                    clearInterval(authTimer));
                }, 1e3);
            } else !res.success && res.errMsg && alert(res.errMsg);
        });
    }
    //表单验证     
    function checkLogin(data) {
        //先隐藏原来的errtip
        $(".u-error-tip").hide();
        var regEmail = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/, //邮箱验证
        regTel = /^[\d]{11}$/, $errPwd = $divUserPwd.find(".u-error-tip"), $errUserName = $divUserEmail.find(".u-error-tip"), $errAuth = $divAuth1.find(".u-error-tip");
        if ("normal" == loginWay) {
            //验证邮箱
            if (!regEmail.test(data.user_email)) return $errUserName.show(), !1;
            //密码没有输入
            if ($errUserName.hide(), data.user_psw.length < 1) return $errPwd.show(), !1;
            //没有输入验证码
            if ($errPwd.hide(), 4 != data.user_auth.length) return $errAuth.show(), !1;
            $errAuth.hide();
        } else if ("mobile" == loginWay) {
            if (//电话号码没有输入  user_email 此时存的是电话号码
            alert(regTel), !regTel.test(data.user_email)) return $divUserTel.find(".u-error-tip").show(), 
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
                    return void alert("服务器异常，稍后再试");
                }
                if ("true" == res.success) res.nextSrc ? location.href = res.nextSrc : alert("服务器异常，稍后再试"); else if (res.no || res.no >= 1 && res.no <= 4) //填写错误
                switch (res.no) {
                  //用户名错误
                    case 1:
                    showInputError($divUserEmail, res.errMsg.inputMsg);
                    break;

                  //密码错误
                    case 2:
                    showInputError($divUserPWd, res.errMsg.inputMsg);
                    break;

                  //电话号码码错误
                    case 3:
                    !function() {
                        "mobile" == loginWay && showInputError($divUserTel, res.errMsg.inputMsg);
                    }();
                    break;

                  //验证码错误
                    case 4:
                    !function() {
                        "normal" == loginWay ? showInputError($divAuth1, res.errMsg.inputMsg) : "mobile" == loginWay && showInputError($divAuth2, res.errMsg.inputMsg);
                    }();
                } else res.errMsg && res.errMsg.otherMsg && //其它错误
                alert(res.errMsg.otherMsg);
            }
        });
    }
    //显示表单的错误
    function showInputError($id, msg) {
        var $tip = $id.find(".u-error-tip");
        msg && $tip.text(msg), $tip.show();
    }
    //登陆模块
    /*
     * @inlude "切换登陆方式"
     * @inlude "验证表单"
     * @include "ajax 登陆"
     * @include "验证码点击切换/发送验证码"
    */
    var $smsBtn = $(".sms-btn");
    //图片验证码
    $(".captcha-img").on("click", function() {
        getAuth({
            auth_way: "image"
        });
    }), //短信验证码
    $smsBtn.on("click", function() {
        getAuth({
            auth_way: "sms",
            timestemp: new Date().getTime(),
            //时间戳
            telNumber: $("#user-mobile").val()
        });
    }), //输入框绑定事件,每次获得焦点时隐藏提示
    $("#register-form input").on("focus", function() {
        $(".u-error-tip").hide();
    });
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
    var $divUserEmail = $("#login-user-name"), $divUserPwd = $("#login-user-pwd"), $divUserTel = $("#login-user-mobile"), $divAuth1 = $("#login-user-auth1"), $divAuth2 = $("#login-user-auth2");
    //表单提交
    $("#login-form").on("submit", function(ev) {
        ev.preventDefault();
        var data = {
            login_way: loginWay,
            //登陆方式
            user_psw: $divUserPwd.find("input").val(),
            //密码
            user_remember: function() {
                return 1 == $("#auto-login")[0].checked ? !0 : !1;
            }(),
            //记住密码自动登录
            user_email: function() {
                return "normal" == loginWay ? $divUserEmail.find("input").val() : "mobile" == loginWay ? $divUserTel.find("input").val() : void 0;
            }(),
            //登陆用户名 || 邮箱||电话号码
            user_auth: function() {
                return "normal" == loginWay ? $divAuth1.find("input").val() : "mobile" == loginWay ? $divAuth2.find("input").val() : void 0;
            }()
        };
        return checkLogin(data) ? (ajaxForm(data), !1) : !1;
    });
});