<?php

namespace Omnipay\JDPay\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\JDPay\Helpers\HttpHelper;
use Omnipay\JDPay\Helpers\SignHelper;

abstract class BaseAbstractRequest extends AbstractRequest
{
    public function getEndpoint($type)
    {
        return $this->endpoint;
    }

    public function getCurrency()
    {
        return 'CNY';
    }

    public function getIp()
    {
        return $this->httpRequest->ip();
    }

    public function getVersion()
    {
        return '1.1.5';
    }

    public function setMchId($mchId)
    {
        $this->setParameter('mch_id', $mchId);
    }

    public function getMchId()
    {
        return $this->getParameter('mch_id');
    }

    public function setDesKey($desKey)
    {
        $this->setParameter('des_key', $desKey);
    }

    public function getDesKey()
    {
        return $this->getParameter('des_key');
    }

    public function setMd5Key($md5Key)
    {
        $this->setParameter('md5_key', $md5Key);
    }

    public function getMd5Key()
    {
        return $this->getParameter('md5_key');
    }

    public function setNotifyUrl($url)
    {
        $this->setParameter('notify_url', $url);
    }

    public function getNotifyUrl()
    {
        return $this->getParameter('notify_url');
    }

    public function setSuccessReturnUrl($url)
    {
        $this->setParameter('success_return_url', $url);
    }

    public function getSuccessReturnUrl()
    {
        return $this->getParameter('success_return_url');
    }

    public function setFailReturnUrl($url)
    {
        $this->setParameter('fail_return_url', $url);
    }

    public function getFailReturnUrl()
    {
        return $this->getParameter('fail_return_url');
    }

    public function getPublicKeyPath()
    {
        return $this->getParameter('public_key_path');
    }

    public function setPublicKeyPath($keyPath)
    {
        if (!is_file($keyPath)) {
            throw new InvalidRequestException("The public_key_path($keyPath) is not exists");
        }
        $this->setParameter('public_key_path', $keyPath);
    }

    public function getPrivateKeyPath()
    {
        return $this->getParameter('private_key_path');
    }

    public function setPrivateKeyPath($keyPath)
    {
        if (!is_file($keyPath)) {
            throw new InvalidRequestException("The private_key_path($keyPath) is not exists");
        }
        $this->setParameter('private_key_path', $keyPath);
    }

    public function getMerchantRemark()
    {
        return $this->getParameter('merchant_remark');
    }

    public function setMerchantRemark($merchant_remark)
    {
        return $this->setParameter('merchant_remark', $merchant_remark);
    }

    public function getToken()
    {
        return $this->getParameter('token');
    }

    public function setToken($token)
    {
        return $this->setParameter('token', $token);
    }

    public function getMerchantSign($param)
    {
        return SignHelper::signWithoutToHex($param);
    }

    public function getTradeType()
    {
        return $this->getParameter('trade_type');
    }
}
