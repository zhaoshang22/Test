<?php 
namespace TestWeChat;

class Rsa {    
    private static $PRIVATE_KEY = '-----BEGIN RSA PRIVATE KEY-----
MIIEpQIBAAKCAQEA31TKMbir1jydNXEnvO8/UahVDXOQxj9pQ7xYvDZO9RNPOaZP
4jQQEdKAPwvcCyRKGGl8UxGfO2fFwM0hL+KoF/CQY8/HluQ/P+T1dOq0ognC2GGR
EE850LQHaBq+4fzGMLmbiTl1/k/H4Pi9CLZmqu8tWiM/4kLjN6PPJRV2IvagT66Y
G1qFjJcfDPWuXoEnfuEx4yYLyR91zkFEQ+Dp1oCNSyQkmusVYz5uBZ2GbD4biF25
ZVTuWPoc5ze7s1uuRpn3324CYxLAVCT7CbBEiK+BIiarONYt9rkh9qrj2rN5amu0
Kb5YdBT9Cq9NGPa4VmurGBXSgK3ldvxtqbns/wIDAQABAoIBAQC5/VAiVmxtD6/R
GPqCIzE1XR3wBOV15MtSiOHRZN0exsT8+t+eP8N+RDNfzg2kDcXTTM4oFA3rGEId
jffsfDOHNGXbaegLZuyx1okApJJoO/7T23VHAuPgRn3Amj2L0MpxO7Indv4oG+MX
Ha+4OMeJ5YR8g8ypLxExfi9978Ch3fpTB+TdTsAeQy659P/+A5orNJ7p7p+S1G/i
2yaVb1orJykMjYkB/cVjx1ltisngi80fsIbaFoyG9N+C5guIOuUTR4IckrBMQQ/v
2hQSMNq3nezoHRA6DLkOLkEOver71V3ydycwKqhLZs64JEPT0HP2DjHNBN+tKiFv
dAb5a6oBAoGBAPNbSS4cVkCkYkRnuawkU2v83dJo6nbnNxP23ecnYmMRIfnaR46y
bMnFeUf/DW3DK5Xzai/7GhnfNrJF7GSZgUzGU5DVGewogq+BT4kG05CBVSvYwOLi
ivcTdXcWfGwTHO0hexMcs3uf2dpovgHbz02sRCj9yJN01jz842TGgJX/AoGBAOrv
KRwEOZHGKWoEinm3ZF7hvKGMmkseSuM8QsDvdPSBn62tByrjcCWumviW+xQsv7MM
esru1hcf4hIzvKQEs6oajO5SZyA/cZ5+iXXf9fnOasyCI1mjJHFSYmEh6xOpxiEB
ec6+aZfr3tE65yE9f++UiQrFpAL5upMTjZOHzKkBAoGAX53gdQOhSCjOi34Nz/s9
49Io/gFHDozucSOwMKCi4bXbmaYQM5sbb3PtoUIvbo8e0v4fHNcWfE/d19HtfeFq
klXig6eXVdjc8ERokbhi7AZFBsNVlk/YthepMa9eF8CyvuFG0E2Yn9xA5rX84hIR
s70Z0tlUM8vWWYQrfG8aGtUCgYEAzleaWsIXMkLC8xvj5/28SV2pCJbumZWUnrq5
wq1OosYK0kbLqc6zHFWcRUSOZ+zZvk/ytbRKE2tsayJHyCNdDcVeDKARdZBjoZpv
7zjy2SKESPTwSXVxt5ptT/SzfMS7gRfDvWMeaVHAlTJP+LEEYg+qwexPHlHqne0p
hu9aQQECgYEArEqClT8f6gb/+RAw79reMn8yigsaeRAtwfzC/YBOgefM3+ax9x9x
5uVUQUcXkf4ddFVjwow+GgukBF6UbbPeqKq6MI89DAUaDIY2k5yT9K+ZSuvkUcKd
8V32sTiEmnLsxPzrL7yOXEROhR++mGLU84y0VsWFjHYNjlJxo3sbIAw=
-----END RSA PRIVATE KEY-----
';    
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