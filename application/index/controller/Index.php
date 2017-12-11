<?php
namespace app\index\controller;
use TestWeChat\Class_weixin_adv;
use TestWeChat\Rsa;
use think\Request;

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
        $data['name'] = 'Tom';
        $data['age']  = '20';
        $rsa = new Rsa();

        $privEncrypt = $rsa->privEncrypt(json_encode($data));
        echo '私钥加密后:'.$privEncrypt.'<br>';

        $publicDecrypt = $rsa->publicDecrypt($privEncrypt);
        echo '公钥解密后:'.$publicDecrypt.'<br>';

        echo '公钥加密后:'.$publicEncrypt.'<br>';

        $privDecrypt = $rsa->privDecrypt($publicEncrypt);
        echo '私钥解密后:'.$privDecrypt.'<br>';

    }
    /**
     * @Author    赵尚
     * @DateTime  2017-12-11
     * @Details   [Rsa 加密 公钥加密接口]
     * @Format    [格式]
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     */
    public function RsaEncrypt(){
          $PublicKey=Request::instance()->param('PublicKey');// 公钥
          $Data=Request::instance()->param('Data');// 被加密数据
          $PUBLIC_KEY = Rsa::$PUBLIC_KEY;// 获取定义公钥
          // var_dump($PublicKey);
          // var_dump($PUBLIC_KEY);die;
          if(self::trimall($PublicKey)==self::trimall($PUBLIC_KEY)){
              $rsa = new Rsa();
              $publicEncrypt = $rsa->publicEncrypt(json_encode($Data));
              return json_encode(['code'=>200,'msg'=>'信息加密成功','data'=>$publicEncrypt]);

          }else{

              return json_encode(['code'=>200,'msg'=>'公钥不正确,请谨慎提交,超过五次您的IP将无法访问']);

          }

    }
    /**
     * @Author    赵尚
     * @DateTime  2017-12-11
     * @Details   [去掉字符串空格]
     * @Format    [格式]
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     * @param     [type]      $str [description]
     * @return    [type]           [description]
     */
    public function  trimall($str)//删除空格

      {

          $oldchar=array(" ","\t","\n","\r");

          $newchar=array("","","","","");

          return str_replace($oldchar,$newchar,$str);

      }

}
