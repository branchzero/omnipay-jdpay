<?php

namespace Omnipay\JDPay;

use Omnipay\Common\AbstractGateway;

abstract class BaseAbstractGateway extends AbstractGateway
{
    public function getTradeType()
    {
        return $this->getParameter('trade_type');
    }

    public function setTradeType($tradeType)
    {
        $this->setParameter('trade_type', $tradeType);
    }

    public function setAppId($appId)
    {
        $this->setParameter('app_id', $appId);
    }

    public function getAppId()
    {
        return $this->getParameter('app_id');
    }

    public function setApiKey($apiKey)
    {
        $this->setParameter('api_key', $apiKey);
    }

    public function getApiKey()
    {
        return $this->getParameter('api_key');
    }

    public function setMchId($mchId)
    {
        $this->setParameter('mch_id', $mchId);
    }

    public function getMchId()
    {
        return $this->getParameter('mch_id');
    }

    public function setNotifyUrl($url)
    {
        $this->setParameter('notify_url', $url);
    }

    public function getNotifyUrl()
    {
        return $this->getParameter('notify_url');
    }

    public function getCertPath()
    {
        return $this->getParameter('cert_path');
    }

    public function setCertPath($certPath)
    {
        $this->setParameter('cert_path', $certPath);
    }

    public function getKeyPath()
    {
        return $this->getParameter('key_path');
    }

    public function setKeyPath($keyPath)
    {
        $this->setParameter('key_path', $keyPath);
    }

    public function purchase($parameters = array ())
    {
        $parameters['trade_type'] = $this->getTradeType();
        return $this->createRequest('\Omnipay\JDPay\Message\CreateOrderRequest', $parameters);
    }

    public function completePurchase($parameters = array ())
    {
        return $this->createRequest('\Omnipay\JDPay\Message\CompletePurchaseRequest', $parameters);
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
