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
    private static $PUBLIC_KEY = '-----BEGIN CERTIFICATE-----
        MIIFYjCCBEqgAwIBAgIQTEzYoPxP6q4VVKh/CQ7ahzANBgkqhkiG9w0BAQsFADCB
        yjELMAkGA1UEBhMCVVMxFzAVBgNVBAoTDlZlcmlTaWduLCBJbmMuMR8wHQYDVQQL
        ExZWZXJpU2lnbiBUcnVzdCBOZXR3b3JrMTowOAYDVQQLEzEoYykgMjAwNiBWZXJp
        U2lnbiwgSW5jLiAtIEZvciBhdXRob3JpemVkIHVzZSBvbmx5MUUwQwYDVQQDEzxW
        ZXJpU2lnbiBDbGFzcyAzIFB1YmxpYyBQcmltYXJ5IENlcnRpZmljYXRpb24gQXV0
        aG9yaXR5IC0gRzUwHhcNMTYwNjA3MDAwMDAwWhcNMjYwNjA2MjM1OTU5WjCBlDEL
        MAkGA1UEBhMCVVMxHTAbBgNVBAoTFFN5bWFudGVjIENvcnBvcmF0aW9uMR8wHQYD
        VQQLExZTeW1hbnRlYyBUcnVzdCBOZXR3b3JrMR0wGwYDVQQLExREb21haW4gVmFs
        aWRhdGVkIFNTTDEmMCQGA1UEAxMdU3ltYW50ZWMgQmFzaWMgRFYgU1NMIENBIC0g
        RzEwggEiMA0GCSqGSIb3DQEBAQUAA4IBDwAwggEKAoIBAQCkN8hYylrZCZihZgN2
        5FsiT+qfOv8rKi3MbRIsZ2TUqsS5e1eDLPXI8IP4XXUZLWt9hlqmDpqiZa5mLSBj
        KDX3iWq/FaOc8l1AsbeOhr9ZESCoEorqm6S9wAL+HX7hLY/7p03SSNSAO+/gr2o7
        ciWu3jhd+H4dzGNNDN0nCuRIOX7rTGYI5mOb8QWJRC6H/3MlUYpBt9VV+l2FVNhB
        LJuofF3TNJojVHximZnTEkybg/r9AZc2TkDHJX1BA6rNjXG8l5iSCL9ICJCBUPB5
        z/s3hQBQkOALXN88QTIrlj53XpWpqxYdQJrOFbtWi18WW3ZAnGAscd8vZ5UIg3KL
        AmoBAgMBAAGjggF2MIIBcjASBgNVHRMBAf8ECDAGAQH/AgEAMC8GA1UdHwQoMCYw
        JKAioCCGHmh0dHA6Ly9zLnN5bWNiLmNvbS9wY2EzLWc1LmNybDAOBgNVHQ8BAf8E
        BAMCAQYwLgYIKwYBBQUHAQEEIjAgMB4GCCsGAQUFBzABhhJodHRwOi8vcy5zeW1j
        ZC5jb20wYQYDVR0gBFowWDBWBgZngQwBAgEwTDAjBggrBgEFBQcCARYXaHR0cHM6
        Ly9kLnN5bWNiLmNvbS9jcHMwJQYIKwYBBQUHAgIwGRoXaHR0cHM6Ly9kLnN5bWNi
        LmNvbS9ycGEwHQYDVR0lBBYwFAYIKwYBBQUHAwEGCCsGAQUFBwMCMCkGA1UdEQQi
        MCCkHjAcMRowGAYDVQQDExFTeW1hbnRlY1BLSS0yLTU1NTAdBgNVHQ4EFgQUXGGe
        sHZBqWqqQwvhx24wKW6xzTYwHwYDVR0jBBgwFoAUf9Nlp8Ld7LvwMAnzQzn6Aq8z
        MTMwDQYJKoZIhvcNAQELBQADggEBAGHqRXEvjeE/CpuVSPHyPKJYFsqWxP/a4quX
        cRCRsy+ki4EP8qT7NfPnkEogxZvlMctHsWgdtTbp9ShXbqCnqXPCw575BZH2rEKN
        xI30CWr6U47n4h2hSnaJxJeeA+xKsA1Vk4v8eLu7xwRlBwhZEsYNFAVpD3YEToek
        H877QzZrZ6EdG/3Vg6sdtHDQ4i/U87syTmyM2l8vXOGIZDd1Wr6dqee2FtCfhvAc
        WMbvh/J6sBOHMq0Vn5G8Tp6iUwsRlY1z7LaQKAlnlOiiZVhhe+1gvzJBHC0t+Hr2
        2YHwaoKDLhSB0F/gGkziNQ+py1hFne4MEOuvzOxJpjn0+wRIbBk=
        -----END CERTIFICATE-----';   
 
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