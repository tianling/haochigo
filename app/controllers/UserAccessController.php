<?php

class UserAccessController extends BaseController{

    public function register(){

        $mobile = Input::get('mobile');
        $email = Input::get('email');


        $password = Input::get('password');
        //对密码进行hash加密
        $password = Hash::make($password);

        $user = new User;
        $user->password = $password;
        $user->last_login_time = time();
        $user->last_login_ip = $this->getIP();
        $user->lock = 0;
        $user->user_type = 'front';
        $user->add_time = time();


        if($user->save()){
            $uid = $user->id;
        }else{
            echo "user base Error";
            exit;
        }


        $frontUser = new FrontUser;
        $frontUser->uid = $uid;
        $frontUser->email = $email;
        $frontUser->mobile = $mobile;
        $frontUser->email_passed = 1;
        $frontUser->mobile_passed = 1;
        $frontUser->integral = 0;
        $frontUser->balance = 0;


        if($frontUser->save()){
            echo "ok";
        }

    }

    public function  index(){
        echo "ok";
    }



    //获取客户端ip地址
    public function getIP(){
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif(!empty($_SERVER["REMOTE_ADDR"])){
            $cip = $_SERVER["REMOTE_ADDR"];
        }
        else{
            $cip = "无法获取！";
        }
        return $cip;
    }
}



?>