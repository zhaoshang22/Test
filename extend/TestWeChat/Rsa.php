<?php 
namespace TestWeChat;

class Rsa {    
    private static $PRIVATE_KEY = '-----BEGIN PRIVATE KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBALe/h4AyuGAXIpKt
CkMXgP6P/IHx1qYmRJXE8Dysfj7oREsKABuLRFqAQJWinWW1VlGs96Ry1ftX8BFM
Zmj5pMeG+VWLBiHITzfLWnHDhy9GYXcNCE9V7CPUOmr+Mosx/TS/kTi+HrqeXbZV
i2Hd+VLpX3wV+XK0FtpePV+TT6ubAgMBAAECgYAv9qPVF+g+1OsmZFrgZns6d7VO
6iTAnA6dFZosDE6r9w8Uk1ix1+mQwheZt6fkS7Brg33lBEDM6gh1S38T+c5EAYDW
7naaiJmcvM5/rzxi60laB4XH95HqAcOSOTG1YwtbXaikZNmmJBDGATst0ukgOKzB
UwtmC0D7qt8wiPo2OQJBAOfuKvAd5LUYsZKnLbQYQXebvWXoxbQnggmHx9pAJZke
D5/5Vlf2iDKB5GZa2QWgJWx7ICEsJA/yokiZWQvghdcCQQDK0UbWviSif0b9WNPF
BzEX9djEJHf36APFIyQ+a5oJdFYWY9JVqlRdie656alFqm8FXq4ddwy6J3AKGunW
3sfdAkAzJBY9uim7MQW+07RFOO/+os3BkfE+R1PqLBGKc4iW2cUSPlWmscrYcEHf
u/qMvgJiiEfOaMBO7+6O2ZmD/+8jAkAbpRz3xmEt+RVPER2EfK93aZ5LVgE4PFrP
MzQMghQz97SIRsDzxkzLlzKACtZ01X9ehwJKp+CHOzrtVa/MBv/NAkEAvVxYpJKK
pUcm8yMcRKO3ztmBqLzKn6jWituKOfXMuwEkBJqaz9diIHHIa+xpKJ/wFXDNnWt0
IEOqB0DB8Az5FQ==
-----END PRIVATE KEY-----';    
    public static $PUBLIC_KEY = '-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC3v4eAMrhgFyKSrQpDF4D+j/yB
8damJkSVxPA8rH4+6ERLCgAbi0RagECVop1ltVZRrPekctX7V/ARTGZo+aTHhvlV
iwYhyE83y1pxw4cvRmF3DQhPVewj1Dpq/jKLMf00v5E4vh66nl22VYth3flS6V98
FflytBbaXj1fk0+rmwIDAQAB
-----END PUBLIC KEY-----';   
 
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