<?php
namespace app\index\controller;
use TestWeChat\Class_weixin_adv;
use TestWeChat\Rsa;

use think\Controller\redirect;
class Index
{

    public function index(){

      return  view('index');

    }
    public function TestWeChat(){
      //开启session 
      $appid = "wx5ab0d0a6996daebf"; //填上appid
      $appsecret = "2d651bfe0b924c3df473ae977463df54"; //填上appsecret
      $weixin= new Class_weixin_adv();

      $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=".input('get.code')."&grant_type=authorization_code";

      $res = $weixin->https_request($url);

      $res=(json_decode($res, true));
      // print_r($res);die;

      $row=$weixin->get_user_info($res['openid']); 
      $openid = $row['openid']; //获取openid
      return redirect('Index/wechat',['openid'=>$openid]);

    }
    public function wechat($openid){

      return view('wechat',['info'=>$openid]); 

    } 

    public function RsaTest(){
        $rsa = new Rsa();
        $data['name'] = 'Tom';
        $data['age']  = '20';
        $privEncrypt = $rsa->privEncrypt(json_encode($data));
        echo '私钥加密后:'.$privEncrypt.'<br>';

        $publicDecrypt = $rsa->publicDecrypt($privEncrypt);
        echo '公钥解密后:'.$publicDecrypt.'<br>';

        $publicEncrypt = $rsa->publicEncrypt(json_encode($data));
        echo '公钥加密后:'.$publicEncrypt.'<br>';

        $privDecrypt = $rsa->privDecrypt($publicEncrypt);
        echo '私钥解密后:'.$privDecrypt.'<br>';

    }
}
