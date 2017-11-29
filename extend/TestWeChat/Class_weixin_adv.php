<?php
namespace TestWeChat;
/**
 * 微信SDK 
 * pan041ymail@gmail.com
 */

class Class_weixin_adv
{
/*  const $appid = "wx5ab0d0a6996daebf"; // 公众号的openid 
    var  const $appsecret = "2d651bfe0b924c3df473ae977463df54"; // 公众号的appsecret*/

    //构造函数，获取Access Token
    public function __construct($appid = NULL, $appsecret = NULL)
    {
            $this->appid = 'wx5ab0d0a6996daebf';
            $this->appsecret = '2d651bfe0b924c3df473ae977463df54';
/*        if($appid==){
        }
        if($appsecret){
        }*/

        
        $this->lasttime = 1395049256;
        $this->access_token = "nRZvVpDU7LxcSi7GnG2LrUcmKbAECzRf0NyDBwKlng4nMPf88d34pkzdNcvhqm4clidLGAS18cN1RTSK60p49zIZY4aO13sF-eqsCs0xjlbad-lKVskk8T7gALQ5dIrgXbQQ_TAesSasjJ210vIqTQ";

        if (time() > ($this->lasttime + 7200)){
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->appsecret;
            $res = $this->https_request($url);
            $result = json_decode($res, true);
            
            $this->access_token = $result["access_token"];
            $this->lasttime = time();
        }
    }
//获取用户基本信息
    public function get_user_info($openid)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->access_token."&openid=".$openid."&lang=zh_CN";
        $res = $this->https_request($url);
        return json_decode($res, true);
    }

//https请求
    public function https_request($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}