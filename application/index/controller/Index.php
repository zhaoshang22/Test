<?php
namespace app\index\controller;
use TestWeChat\Class_weixin_adv;
class Index
{

    public function index(){

      return  view('index');

    }
    public function TestWeChat(){
      //开启session 
      // echo "hello word 赵尚";die;
      $appid = "wx5ab0d0a6996daebf"; //填上appid
      $appsecret = "2d651bfe0b924c3df473ae977463df54"; //填上appsecret
      $weixin= new Class_weixin_adv();

      $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=".input('get.code')."&grant_type=authorization_code";

      $res = $weixin->https_request($url);

      $res=(json_decode($res, true));
      // print_r($res);die;

      $row=$weixin->get_user_info($res['openid']); 
      $openid = $row['openid']; //获取openid

      // $unionid = $row['unionid'];  //获取uniond
      
      print_r($res);
      print_r($row);
    }
}
