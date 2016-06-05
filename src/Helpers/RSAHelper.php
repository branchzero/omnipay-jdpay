<?php

namespace Omnipay\JDPay\Helpers;

class RSAHelper
{
    public static function encryptByPrivateKey($data)
    {
        $pi_key =  openssl_pkey_get_private(file_get_contents('../config/seller_rsa_private_key.pem'));
        $encrypted="";
        openssl_private_encrypt($data, $encrypted, $pi_key, OPENSSL_PKCS1_PADDING);
        $encrypted = base64_encode($encrypted);

        return $encrypted;
    }
    
    public static function decryptByPublicKey($data)
    {
        $pu_key =  openssl_pkey_get_public(file_get_contents('../config/wy_rsa_public_key.pem'));
        $decrypted = "";
        $data = base64_decode($data);
        openssl_public_decrypt($data, $decrypted, $pu_key);

        return $decrypted;
    }
}
