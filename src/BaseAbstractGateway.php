<?php

namespace Omnipay\JDPay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Exception\InvalidRequestException;

abstract class BaseAbstractGateway extends AbstractGateway
{
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

    public function purchase($parameters = array ())
    {
        $parameters['trade_type'] = $this->getTradeType();
        return $this->createRequest('\Omnipay\JDPay\Message\PurchaseRequest', $parameters);
    }

    public function completePurchase($parameters = array ())
    {
        return $this->createRequest('\Omnipay\JDPay\Message\CompletePurchaseRequest', $parameters);
    }

    public function notify($parameters = array ())
    {
        return $this->createRequest('\Omnipay\JDPay\Message\NotifyRequest', $parameters);
    }

    public function query($parameters = array ())
    {
        return $this->createRequest('\Omnipay\JDPay\Message\QueryRequest', $parameters);
    }

    public function refund($parameters = array ())
    {
        return $this->createRequest('\Omnipay\JDPay\Message\RefundRequest', $parameters);
    }
}
