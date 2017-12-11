<?php 
namespace TestWeChat;

class Rsa {    
    private static $PRIVATE_KEY = '-----BEGIN RSA PRIVATE KEY-----
        MIIEpAIBAAKCAQEA6bAQHo4SIN7+r+CPuhWleA/URjRBIjsIHl6igqUanM6BkSsq
        KFZAk1NgCfrY5lQ4Eo5NlxW1XyP+KkKsq7/SmbW1Yrj/TisbyE7uvWcN4IH08zrh
        rnoY5ZwnzNcMSsAcZR2cSLRGH/pEpm7dnW//sr2iO0U/q4IqV/yryFLv8HHncnp+
        2NCiNqpb0wtoNtMACqz/JPAVmG1fKsTtCOxd6AGAg0Ufk/8+JqXkSihGgyg6d4ek
        zg7uibgTF0HrS8OdNKuu2GlplLbdzcDUosNWMTLGHLAeZIVEkpYiEXGycPKF7ZgM
        /RpBoztxTxbbpWQj1V2+tyT5GRM65d848JojqQIDAQABAoIBAAxsS68UJmqQ8EEx
        UvK1i+JiFQrWZFAJi1jx9vmzBUMox0KMZOVYEH7Eg+qD51v3RjPWVNGfWdEA/NYK
        TVukCvIY8teYthnVuNhhOdffzqEMx5TWoIDCBOjP8F23YPPoWpoVhOVokAHLMDMY
        2bcw6Qr7gdBc0hGwDcg3qnovzomdqorBz/ePEQKiyLPUzqvEd9iZ79nUM0iBLrDR
        2JzeQ3hOGsXEgPX/ll1dstmC8j6UdUJyf0+wXXRsvE4b66zUATZg9uopz7lAIKKY
        KYyKkEGBUZ5IuzI6RN0yU8mz/z1dzITd1tSf7Rj7q85cUmHVmnaZcSjqA8h/mE2L
        3kPQqAECgYEA9OgNWulFf5ZRpMLBpK2NHiMxpbGvpZTxWV/G6L9iNHSbDaOpmXUA
        pZxOm0K8WD/dP7gtwjcCQtZNxbzD1Hup+F7QJW/wDtDz1qUF+Y/WC7rEZhaiPVyb
        bAQKILuRyxDS41jJoeuYk5D8naztKZ6f6RoaKmLKaUNKcLZHxf/57ekCgYEA9EXr
        B55+dIDpqfBvM3nCPKU4TbX3dwQJv7GtFbkEHJ+qaS8Ei4WH09dXkDbnZJk2H5E5
        bN0GahmJZ02LLycfX0vZ+N2xWooqWPYeMEHx71gKzWOj9fmyqBmgzQQumpA/08Nd
        k73VBnkPJ4s6ZNy83BNyCSJy59MvTqhgy26AL8ECgYEArLaBxJ1B/+p4hWM7wPEL
        1jcnqhyXLITPeCINWtKtZSTevE2xK6HR5PlIjkIQJYRUeb1ft9mnZI9RpaOrz0uu
        4JOs4toAR9KgQ715azg+0WLTYtOPcwq+KPzoT5E4Dic9MkvJVsGZhmf3XxM25eUS
        DQf1b/LfoEBuXPKPx1jwXxECgYAgvIoOAFi0Jl6qTrWocWXtmLrd90gN5DWmQhqP
        MbdyWpeM9yclx6R3aIGsqx8BpWLSgjTu+QQWDgwTExpXHGgg7lps9tEA8ElSmNFc
        6EmTKPpxoivkGC2wR5b8QtY4EqLrL2CIH0XAU1MLmqYdxFNvLw/2V26M0QmjAf/O
        46U8QQKBgQCGzJjGqH1KArNVUFJXOmJniKmLzKrhODoUum89yDUI3Hruto1JhiZO
        lgtXT+fL20jXq3ZObS8vYyI1M/K0f16Or8rKZCUkrW2bURdk+RzUhvXMi1cR3TGv
        8Ievm1dePNHy4moydgO6odYEk2NgfEiaWyFuEUYO5f8VJ/7SCanAKQ==
        -----END RSA PRIVATE KEY-----';    
    private static $PUBLIC_KEY = 'AAAAB3NzaC1yc2EAAAADAQABAAABAQDpsBAejhIg3v6v4I+6FaV4D9RGNEEiOwgeXqKCpRqczoGRKyooVkCTU2AJ+tjmVDgSjk2XFbVfI/4qQqyrv9KZtbViuP9OKxvITu69Zw3ggfTzOuGuehjlnCfM1wxKwBxlHZxItEYf+kSmbt2db/+yvaI7RT+rgipX/KvIUu/wcedyen7Y0KI2qlvTC2g20wAKrP8k8BWYbV8qxO0I7F3oAYCDRR+T/z4mpeRKKEaDKDp3h6TODu6JuBMXQetLw500q67YaWmUtt3NwNSiw1YxMsYcsB5khUSSliIRcbJw8oXtmAz9GkGjO3FPFtulZCPVXb63JPkZEzrl3zjwmiOp';   
 
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