define(['jquery'], function($){
    var timer = 0;
    window.$=$;
    $('#sendVerifyCode').on('click', sendVerify);
    function sendVerify(e){
        var oriPhone = $('#oriPhone').val();
        var newPhone = $('#newPhone').val();
        var reg = /^\d{11}$/;
        if(reg.test(oriPhone) && reg.test(newPhone)){
            $.ajax({
                url: "/takeaway/public/ajax_change_phone",
                type: "POST",
                data: {
                    original_phone: oriPhone,
                    new_phone: newPhone
                },
                success: function(res){
                    if(res.success == 'true'){
                        alert('验证码已发送, 请注意查收.');
                        codeInterval();
                    }else{
                        alert('原手机号错误!');
                    }
                }
            });
        }else{
            alert('请填写正确的手机号码.');
        }
    }
    function codeInterval(){
        $('#sendVerifyCode').attr('disabled', 'disabled');
        var i = 61;
        function oneSec(){
            i--;
            if(i == 0){
                $('#sendVerifyCode').html('发送验证码');
                return $('#sendVerifyCode').attr('disabled', false);
            }
            $('#sendVerifyCode').html('等待' + i + '秒重新获取验证码');
            setTimeout(oneSec, 1000);
        }
        oneSec();
    }

	console.log("personal change phone loaded");

});