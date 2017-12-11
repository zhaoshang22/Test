<?php 
namespace TestWeChat;

class Rsa {    
    private static $PRIVATE_KEY = '-----BEGIN DSA PARAMETERS-----
                        MIICLQKCAQEAzR5OcCDLUpCneJJs1xacfPY0tCnvjob3HWCcEikix0xHbgYrTMPo
                        kf4eNFqHTkJ8oiPPynBg5GxqzQarAwe+oxkfNdLOOSy2cMfOTYgNzhoBel5fL++A
                        0SwOU3vIwmcv/hrEYWxNapHi3ff1cyY9/EG3Wc4mDipHsA+WxDHHctlDgvCsyRI7
                        medp1PZqzFnKzjtTSaHfX5uVdRpSWAr5o+j8xnDrKM9wrXRj9QlrmR5Mbm7cPC3m
                        3EapIoQDTOtfHpnuPK8+jhoBxlh40PqEhL4PX7a3W9YhkstaI5B7fEcJofv0p8J2
                        mcSeFr7sXpgQEfcrkfawoQfB5oH5mxFAwQIhAJ0utS+6i+jA0Xw0mr1iS58vbjPK
                        7sAHHGlfTE4fZ8o/AoIBAQCMgjyQj1gNPlu6QfcliVNINcozGU7nSesIwrYcR+Ub
                        1i28MjZXivJ8LN4Oirx3giYBxNFqYwlBw6uwsxrJ0k0BzoJqOffFbf06i9+daoeL
                        0Vp96Zbc0+QpF6du5ozjgZSFj4D2CQnjDB4cwZ0KZY3EMSQLpxXs1+qJ20QXcCjq
                        Ilrm9XKxlc7ct45nMno2u61mZ5SmFgWHNTHz32caDn/M55KgwSThrQYV/GrJ3YvT
                        XEp9XdZsR4xhVe0L4cuL/9Jrb3P6cCyoNxSCjYPvgj/UfD8Zc2lPrCT8VI3Y0Xg4
                        XIsmFiqwhoZ9m+Relxn43tWBcjKFSTYo/DicGkvW5mGp
                        -----END DSA PARAMETERS-----';    
    private static $PUBLIC_KEY = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCoZZ8iUBprOIc0kGckr5ax6/Fd9IKKMc/XHayKEAvqpS0oz0b1ojEkpkdZBk0OWNhp73YNV+YLKBwwxOwb3u3hl8nBLoG/RilEbBMdCf55cUzNsfn/XF5CiLr/aci/OHuTe6ULvXs280T5M+nUh3iKdiT6z9XrFbH69C+xFoNInwIDAQAB';   
 
    /**     
     * 获取私钥     
     * @return bool|resource     
     */    
    private static function getPrivateKey() 
    {        
        $privKey = self::$PRIVATE_KEY;        
        return openssl_pkey_get_private($privKey);    
    }    

    /**     
     * 获取公钥     
     * @return bool|resource     
     */    
    private static function getPublicKey()
    {        
        $publicKey = self::$PUBLIC_KEY;        
        return openssl_pkey_get_public($publicKey);    
    }    

    /**     
     * 私钥加密     
     * @param string $data     
     * @return null|string     
     */    
    public static function privEncrypt($data = '')    
    {        
        if (!is_string($data)) {            
            return null;       
        }        
        return openssl_private_encrypt($data,$encrypted,self::getPrivateKey()) ? base64_encode($encrypted) : null;    
    }    

    /**     
     * 公钥加密     
     * @param string $data     
     * @return null|string     
     */    
    public static function publicEncrypt($data = '')   
    {        
        if (!is_string($data)) {            
            return null;        
        }        
        return openssl_public_encrypt($data,$encrypted,self::getPublicKey()) ? base64_encode($encrypted) : null;    
    }    

    /**     
     * 私钥解密     
     * @param string $encrypted     
     * @return null     
     */    
    public static function privDecrypt($encrypted = '')    
    {        
        if (!is_string($encrypted)) {            
            return null;        
        }        
        return (openssl_private_decrypt(base64_decode($encrypted), $decrypted, self::getPrivateKey())) ? $decrypted : null;    
    }    

    /**     
     * 公钥解密     
     * @param string $encrypted     
     * @return null     
     */    
    public static function publicDecrypt($encrypted = '')    
    {        
        if (!is_string($encrypted)) {            
            return null;        
        }        
    return (openssl_public_decrypt(base64_decode($encrypted), $decrypted, self::getPublicKey())) ? $decrypted : null;    
    }
}


 ?>