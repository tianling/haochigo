define([ "jquery" ], function($) {
    function sendVerify() {
        var oriPhone = $("#oriPhone").val(), newPhone = $("#newPhone").val(), reg = /^\d{11}$/;
        reg.test(oriPhone) && reg.test(newPhone) ? $.ajax({
            url: "/takeaway/public/ajax_change_phone",
            type: "POST",
            data: {
                original_phone: oriPhone,
                new_phone: newPhone
            },
            success: function(res) {
                "true" == res.success ? (alert("验证码已发送, 请注意查收."), codeInterval()) : alert("原手机号错误!");
            }
        }) : alert("请填写正确的手机号码.");
    }
    function codeInterval() {
        function oneSec() {
            return i--, 0 == i ? ($("#sendVerifyCode").html("发送验证码"), $("#sendVerifyCode").attr("disabled", !1)) : ($("#sendVerifyCode").html("等待" + i + "秒重新获取验证码"), 
            void setTimeout(oneSec, 1e3));
        }
        $("#sendVerifyCode").attr("disabled", "disabled");
        var i = 61;
        oneSec();
    }
    window.$ = $, $("#sendVerifyCode").on("click", sendVerify), console.log("personal change phone loaded");
});