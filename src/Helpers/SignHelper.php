<?php

namespace Omnipay\JDPay\Helpers;

class SignHelper
{
    public static $unSignKeyList = array(
        'merchantSign',
        'version',
        'successCallbackUrl',
        'forPayLayerUrl'
    );

    public static function signWithoutToHex($params)
    {
        ksort($params);
        $sourceSignString = self::signString($params, self::$unSignKeyList);
        error_log($sourceSignString, 0);
        $sha256SourceSignString = hash('sha256', $sourceSignString, true);
        error_log($sha256SourceSignString, 0);

        return RSAHelper::encryptByPrivateKey($sha256SourceSignString);
    }

    public static function sign($params)
    {
        ksort($params);
        $sourceSignString = self::signString($params, self::$unSignKeyList);
        error_log($sourceSignString, 0);
        $sha256SourceSignString = hash('sha256', $sourceSignString);
        error_log($sha256SourceSignString, 0);

        return RSAHelper::encryptByPrivateKey($sha256SourceSignString);
    }

    public static function signString($params, $unSignKeyList)
    {
        $sb = '';
        foreach ($params as $k => $arc) {
            for ($i = 0; $i < count($unSignKeyList); $i ++) {
                if ($k == $unSignKeyList [$i]) {
                    unset($params [$k]);
                }
            }
        }
        foreach ($params as $k => $arc) {
            $sb = $sb . $k . '=' . ($arc == null ? '' : $arc) . '&';
        }

        return substr($sb, 0, -1);
    }
}
