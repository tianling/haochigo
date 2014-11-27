define(["jquery"], function($){
    //注册表单
    /*
     *验证
     *ajax
     *点击验证码切换
    */

    //验证码点击切换
    $(".captcha-img").on("click",function(){
        $.get("/switch_auth",function(res){
            if( typeof res != object ){
                try{
                    res = $.parseJSON(res);
                }catch(err){
                    alert("服务器数据异常，稍后再试");
                    return ;
                }
            }

            if( res.success && res.nextSrc ){
                $(".captcha-img").attrs("src",res.nextSrc);
            }else if( !res.success && res.errMsg){
                alert(res.errMsg);
            }

        });
    });

	var $divUserMobile  = $("#register-user-mobile"),
        $divUserPwd     = $("#user-pwd"),
        $divUserRePwd   = $("#user-re-pwd"),
        $divUserEmail   = $("#register-user-email"),
        $divAuth        = $("#register-user-auth");
  
    //验证所填数据
    function checkRegister(data){
        //normal err tip
        var $errPwd      = $divUserPwd.find(".u-error-tip"),
            $errMobile   = $divUserMobile.find(".u-error-tip"),
            $errRePwd    = $div.UserRwd.find("u-error-tip"),
            $errAuth     = $divAuth.find(".u-error-tip"),
            $errEmail    = $divEmail.find(".u-error-tip");

        //验证正则
    	var regEmail   = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+/,
    	    regAuth    = / /,
    	    regTel  = / /,
    	    regPwd     = / /;


    	//验证电话号码
    	if( !regTel.test(data.user_phone) ){
            $errMobile.show();
    		return false;
    	}else{
    		$errMobile.hide();
    	}

    	//验证邮箱
    	if( !regEmail.test(data.user_email) ){
            $errEmail.show();
    		return false;
    	}else{
    		$errEmail.hide();
    	}

    	//验证验证密码
    	if( !regPwd.test(data.user_psw) ){
            $errPwd.show();
    		return false;
    	}else{
    		$errPwd.hide();
    	}

    	//验证验证密码是否相同
    	if( data.user_psw != $divUserRePwd.find("input").val() ){
            $errRePwd.show();
    		return false;
    	}else{
    		$errRePwd.hide();
    	}

    	//验证码
    	if( !regAuth.test(data.user_auth) ){
            $errAuth.show();
    		return false;
    	}else{
    		$errAuth.hide();
    	}

    	return true;

    }

    //ajax
    function ajaxForm(data){
    	$.ajax({
    		url      : '/register', 
    		type     :  'post',
    		dataType :  'json',
    		data     :  data,

    		success  : function(res){
                if( typeof res != object ){
                    try{
                        res = $.parseJSON(res);
                    }catch(err){
                        alert("服务器异常，稍后再试");
                        return;
                    }
                }

                if( res.success == 'true'){
                	if(res.nextSrc){
                		location.href = res.nextSrc;
                	}else{
                		alert("服务器异常，稍后再试");
                	}
                    
                }else{
                    if( res.no || (res.no >= 1 && res.no <= 4) { //填写错误

                        switch( res.no ){
                            //用户名错误
                            case 1: showInputError($divUserName,res.errMsg.inputMsg);
                            break;
                            
                            //密码错误
                            case 2: showInputError($divUserPWd,res.errMsg.inputMsg);
                            break;

                            //电话号码码错误
                            case 3: (function(){
                                if(loginWay == "mobile"){
                                    showInputError($divUserTel,res.errMsg.inputMsg);
                                }
                            })();
                            break;
                            
                            //验证码错误
                            case 4: (function(){

                                if( loginWay == "normal" ){ showInputError($divAuth1,res.errMsg.inputMsg);}
                                 else if(loginWay == "mobile"){ showInputError($divAuth2,res.errMsg.inputMsg);}

                            })();
                            break;
                        }

                    }else if(res.errMsg && res.errMsg.otherMsg){ //其它错误
                        alert(res.errMsg.otherMsg);
                    }
                }

            }

    	});
    }
    
    //提交表单
    $("#register-form").on("submit",function(){
    	var data = {
    		'user_phone' : $divUserMobile.find("input").val(),   //电话号码
    		'user_psw'   : $divUserPwd.find("input").val(),    //密码
    		'user_email' : $divUserEmail.find("input").val(),  //邮箱
    		'user_name'  : $divUserName.find("input").val(),   //用户名
    		'user_auth'  : $divAuth.find("input").val()        //验证码
    	};

    	if( !checkRegister(data) ){
    		return false;
    	}

    	ajaxForm(data);

    	return false;
    });
});

