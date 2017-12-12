<?php
namespace app\index\controller;
use TestWeChat\Class_weixin_adv;
use TestWeChat\Rsa;
use think\Request;
use think\Cache;

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
     * @DateTime  2017-12-12
     * @Details   [公钥解密接口]
     * @Format    [格式]
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     */
    public function PublicKeyDecode(){

          $Data=(Request::instance()->param(true));// 被加密数据
          $PUBLIC_KEY = Rsa::$PUBLIC_KEY;// 获取定义公钥

          if(empty($Data)){
              
              return json_encode(['code'=>201,'msg'=>'数据为空']);

          }

          if(self::trimall('-----BEGIN PUBLIC KEY-----'.$Data['PublicKey'].'-----END PUBLIC KEY-----')==self::trimall($PUBLIC_KEY)){
              if($sha1=Cache::get(sha1($Data['PrivDecryptData']))){

                if($sha1==$Data['PrivDecryptData']){
                  $rsa = new Rsa();
                  $privDecrypt = $rsa->publicDecrypt($sha1);
                    if($privDecrypt){

                        return json_encode(['code'=>200,'msg'=>'访问数据解密成功','data'=>json_decode($privDecrypt)]);
                    }else{

                        return json_encode(['code'=>201,'msg'=>'访问数据解密失败']);

                    }
                }else{
                        return json_encode(['code'=>201,'msg'=>'访问数据解密失败']);

                }

              }else{
                  return json_encode(['code'=>201,'msg'=>'访问加密数据不存在']);

              }
              
          }else{
              return json_encode(['code'=>200,'msg'=>'公钥不正确,请谨慎提交,超过五次您的IP将无法访问']);

          }

    }

    /**
     * @Author    赵尚
     * @DateTime  2017-12-12
     * @Details   [私钥加密后  公钥解密]
     * @Format    [格式]
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     */
    public function PrivateKeyEncrypt(){

          $Data=(Request::instance()->param(true));// 被加密数据
          if(empty($Data)){

              return json_encode(['code'=>201,'msg'=>'数据为空']);

          }
          $rsa = new Rsa();
          $privEncrypt = $rsa->privEncrypt(json_encode($Data));
          if($privEncrypt){
              Cache::set(''.sha1($privEncrypt).'',$privEncrypt,20);
              return json_encode(['code'=>200,'msg'=>'请求数据加密成功','data'=>$privEncrypt]);
          }else{

              return json_encode(['code'=>200,'msg'=>'请求数据加密失败']);

          }


    }

    /**
     * @Author    赵尚
     * @DateTime  2017-12-11
     * @Details   [公钥加密后  私钥解密]
     * @Format    [格式]
     * @copyright [copyright]
     * @license   [license]
     * @version   [version]
     */
    public function RsaDecodePrivate(){

          $PublicKeyDate=Request::instance()->param('PublicKeyDate');// 公钥
          if($sha1=Cache::get(sha1($PublicKeyDate))){
              if($sha1==$PublicKeyDate){
                $rsa = new Rsa();
                $privDecrypt = $rsa->privDecrypt($sha1);
                if($privDecrypt){

                    return json_encode(['code'=>200,'msg'=>'请求数据解密成功','data'=>json_decode($privDecrypt)]);
                }else{

                    return json_encode(['code'=>201,'msg'=>'请求数据解密失败']);

                }

              }else{
                    return json_encode(['code'=>201,'msg'=>'请求数据解密失败']);

              }
          }else{
              
              return json_encode(['code'=>201,'msg'=>'请求加密数据不存在']);

          } 
          


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
    public function RsaEncryptPublic(){

          $Data=(Request::instance()->param(true));// 被加密数据
          $PUBLIC_KEY = Rsa::$PUBLIC_KEY;// 获取定义公钥

          if(self::trimall('-----BEGIN PUBLIC KEY-----'.$Data['PublicKey'].'-----END PUBLIC KEY-----')==self::trimall($PUBLIC_KEY)){
              $rsa = new Rsa();
              unset($Data['PublicKey']);
              $publicEncrypt = $rsa->publicEncrypt(json_encode($Data));
              Cache::set(''.sha1($publicEncrypt).'',$publicEncrypt,20);
              return json_encode(['code'=>200,'msg'=>'访问数据加密成功','data'=>$publicEncrypt]);

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
