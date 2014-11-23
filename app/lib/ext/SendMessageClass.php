<?php
/*
**Author:tianling
**createTime:14-11-23 下午1:49
**短信发送API库
*/

class SendMessageClass{

    /**
     * 待发送手机号码
     */
    public $mobile;

    /**
     * 云片短信系统APIkey
     */
    private $apiKey = '85e124b9b3f124e8b7670c2db2813548';

    /**
     * 模板id
     */
    public $tpl_id;

    /**
     * 模板值
     */
    public $tpl_value;

    /**
     * 模板接口发短信
     * apikey 为云片分配的apikey
     * tpl_id 为模板id
     * tpl_value 为模板值
     * mobile 为接受短信的手机号
     */
    public function tpl_send(){

        $url="http://yunpian.com/v1/sms/tpl_send.json";
        
        $encoded_tpl_value = urlencode("$this->tpl_value");
        $post_string="apikey=$this->apiKey&tpl_id=$this->tpl_id&tpl_value=$encoded_tpl_value&mobile=$this->mobile";
        return $this->sock_post($url, $post_string);
    }

    /**
     * url 为服务的url地址
     * query 为请求串
     */
    function sock_post($url,$query){
        $data = "";
        $info=parse_url($url);
        $fp=fsockopen($info["host"],80,$errno,$errstr,30);
        if(!$fp){
            return $data;
        }
        $head="POST ".$info['path']." HTTP/1.0\r\n";
        $head.="Host: ".$info['host']."\r\n";
        $head.="Referer: http://".$info['host'].$info['path']."\r\n";
        $head.="Content-type: application/x-www-form-urlencoded\r\n";
        $head.="Content-Length: ".strlen(trim($query))."\r\n";
        $head.="\r\n";
        $head.=trim($query);
        $write=fputs($fp,$head);
        $header = "";
        while ($str = trim(fgets($fp,4096))) {
            $header.=$str;
        }
        while (!feof($fp)) {
            $data .= fgets($fp,4096);
        }
        return $data;
    }




}