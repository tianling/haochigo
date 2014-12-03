define([ "jquery" ], function($) {
    //验证码ajax请求
    function getAuth(data) {
        $.post("/switch_auth", data, function(res) {
            if (typeof res != object) try {
                res = $.parseJSON(res);
            } catch (err) {
                return void alert("服务器数据异常，稍后再试");
            }
            if (res.success) {
                alert("短信已经发送，请注意接收验证码"), //计时禁止连续发送30秒
                $smsBtn.attr("disabled", "disabled");
                var count = 30, orginText = $smsBtn.text(), authTimer = setInterval(function() {
                    $smsBtn.text(count-- + "秒后可再发送"), 1 > count && ($smsBtn.text(orginText).removeAttr("disabled"), 
                    clearInterval(authTimer));
                }, 1e3);
            } else !res.success && res.errMsg && alert(res.errMsg);
        });
    }
    //验证所填数据4
    function checkRegister(data) {
        //先隐藏原来的errtip
        $(".u-error-tip").hide();
        //normal err tip
        var $errPwd = $divUserPwd.find(".u-error-tip"), $errMobile = $divUserMobile.find(".u-error-tip"), $errRePwd = $divUserRePwd.find(".u-error-tip"), $errAuth = $divAuth.find(".u-error-tip"), $errEmail = $divUserEmail.find(".u-error-tip"), regEmail = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/, //邮箱验证
        regAuth = /^[a-z0-9A-Z]+$/, //验证码 0-9，a-z
        regTel = /^[\d]{11}$/, //电话号码目前仅支持11位
        regPwd = /^[\w]{6,20}$/;
        //验证电话号码
        //密码 大于六位 0-9a-zA-Z_
        //验证电话号码
        //验证邮箱
        //验证验证密码
        //验证验证密码是否相同
        //验证码
        return console.log(data.user_phone), regTel.test(data.user_phone) ? ($errMobile.hide(), 
        regEmail.test(data.user_email) ? ($errEmail.hide(), regPwd.test(data.user_psw) ? ($errPwd.hide(), 
        data.user_psw != $divUserRePwd.find("input").val() ? ($errRePwd.show(), !1) : ($errRePwd.hide(), 
        regAuth.test(data.user_auth) ? ($errAuth.hide(), !0) : ($errAuth.show(), !1))) : (-$errPwd.show(), 
        !1)) : ($errEmail.show(), !1)) : ($errMobile.show(), !1);
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
                    return void alert("服务器异常，稍后再试");
                }
                if ("true" == res.success) res.nextSrc ? location.href = res.nextSrc : alert("服务器异常，稍后再试"); else if (res.no || res.no >= 1 && res.no <= 4) //填写错误
                switch (res.no) {
                  //邮箱错误
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
    //注册表单
    /*
     *@include 验证
     *@include ajax
     *@inclde 点击验证码切换/发送验证码
    */
    var $smsBtn = $(".sms-btn");
    //短信验证码
    $smsBtn.on("click", function() {
        getAuth({
            auth_way: "sms",
            timestemp: new Date().getTime(),
            //时间戳
            telNumber: $("#register-user-mobile").val()
        });
    }), //输入框绑定事件,每次获得焦点时隐藏提示
    $("#register-form input").on("focus", function() {
        $(".u-error-tip").hide();
    });
    var $divUserMobile = $("#register-user-mobile"), $divUserPwd = $("#user-pwd"), $divUserRePwd = $("#user-re-pwd"), $divUserEmail = $("#register-user-email"), $divAuth = $("#register-user-auth");
    //提交表单
    $("#register-form").on("submit", function(ev) {
        ev.preventDefault();
        var data = {
            user_phone: $divUserMobile.find("input").val(),
            //电话号码
            user_psw: $divUserPwd.find("input").val(),
            //密码
            user_email: $divUserEmail.find("input").val(),
            //邮箱
            user_auth: $divAuth.find("input").val()
        };
        return checkRegister(data) ? (ajaxForm(data), !1) : !1;
    });
});