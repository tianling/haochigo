define(['jquery'], function($){
    //登陆模块

    /*
     * @inlude "切换登陆方式"
     * @inlude "验证表单"
     * @include "ajax 登陆"
     * @include "验证码点击切换"
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
     
    //切换登陆方式
    //记录以哪种方式登陆(默认以正常方式登陆)
    var loginWay = "normal";

    //切换按钮
    var $switchMobile = $("#switch-mobile"),
        $switchNormal = $("#switch-normal");

    //切换容器
    var $mobileLoginW = $(".js-mobile-wapper"),
        $normalLoginW = $(".js-normal-wapper");

    //$switchMobile  ==> $mobileLoginW
    //switchNormal   ==> $normalLoginW

    //切换到mobile
    $switchMobile.on("click",function(){
        $(this).hide();
        $switchNormal.show();

        $mobileLoginW.show();
        $normalLoginW.hide();

        loginWay = "mobile";

        //隐藏所有错误提示
        $(".u-error-tip").hide();

    });
    
    //切换到normal
    $switchNormal.on("click",function(){
        $(this).hide();
        $switchMobile.show();

        $normalLoginW.show();
        $mobileLoginW.hide();

        loginWay = "normal";

        //隐藏所有错误提示
        $(".u-error-tip").hide();
    });

    var $divUserName = $("#login-user-name"),
        $divUserPwd  = $("#login-user-pwd"),
        $divUserTel  = $("#login-user-mobile"),
        $divAuth1    = $("#login-user-auth1"),
        $divAuth2    = $("#login-user-auth2");

    //表单验证     
    function checkLogin(data){


        //normal err tip
        var $errPwd      = $divUserPwd.find(".u-error-tip"),
            $errUserName = $divUserName.find(".u-error-tip"),
            $errAuth     = $divAuth1.find(".u-error-tip");
        
        if( loginWay == 'normal'){
            //用户名没有输入
            if( data.user_email.length < 1 ){
                $errUserName.show();
                return false;
            }else{
                $errUserName.hide();
            }
            
            //密码没有输入
            if( data.user_psw.length < 1 ){
                $errPwd.show();
                return false;
            }else{
                $errPwd.hide();
            }

            //没有输入验证码
            if( data.user_auth.length != 4 ){
                $errAuth.show();
                return false;
            }else{
                $errAuth.hide();
            }

        }else if( loginWay == 'mobile'){
            //电话号码没有输入
            if( !/^[\d]{11}$/.test(data.user_email) ){
                $divUserTel.find(".u-error-tip").show();
                return false;
            }

            //没有输入验证码
            if( data.user_auth.length < 1 ){
                $divAuth2.find(".u-error-tip").show();
                return false;
            }
        }

        return true;
    }
    
    //ajax
    function ajaxForm(data){
        $.ajax({
            url      : '/login',
            type     :  'post',
            dataType :  'json',
            data     :  data,

            success : function(res){
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
    
    //显示表单的错误
    function showInputError($id,msg){
        var $tip = $id.find(".u-error-tip");

        if(msg){
            $tip.text(msg);
        }

        $tip.show();
    }

    //表单提交
    $("#login-form").on("submit",function(ev){
        var data = {
            'user_psw'      : $divUserPwd.find("input").val(),          //密码

            'user_remember' : (function(){
                   if( $("#auto-login")[0].checked == true )return true;
                   return false;
            }()),                                                        //记住密码自动登录

            'user_email' : (function(){

                if( loginWay == 'normal' ){return $divUserName.find("input").val();}
                else if( loginWay == 'mobile') {return $divUserTel.find("input").val();}

            })(),                                                       //登陆用户名 || 邮箱||电话号码

            'user_auth' : (function(){

                if( loginWay == 'normal' ){return $divAuth1.find("input").val();}
                else if( loginWay == 'mobile') {return $divAuth2.find("input").val();}

            }())                                                          //验证码

        };
        
        if( !checkLogin(data) ){
            return false;
        }
        
        ajaxForm(data);

        return false;
    });

});