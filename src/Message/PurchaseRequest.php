<?php

namespace Omnipay\JDPay\Message;

use Omnipay\JDPay\Helpers\SignHelper;

class PurchaseRequest extends BaseAbstractRequest
{
    protected $endpoint = array(
        'web'    => 'https://plus.jdpay.com/nPay.htm',
        'mobile' => 'https://m.jdpay.com/wepay/web/pay',
    );

    public function getEndpoint($type)
    {
        return $this->endpoint[$this->getTradeType()];
    }

    protected function validateData()
    {
        $this->validate(
            'mch_id',
            'merchant_remark',
            'notify_url',
            'success_return_url',
            'trade_amount',
            'trade_description',
            'trade_name',
            'trade_num',
            'token'
        );
    }

    public function getData()
    {
        $this->validateData();
        if ($this->getTradeType() == 'web') {
            $data = array(
                'currency'           => $this->getCurrency(),
                'ip'                 => $this->getIp(),
                'merchantNum'        => $this->getMchId(),
                'merchantRemark'     => $this->getMerchantRemark(),
                'notifyUrl'          => $this->getNotifyUrl(),
                'successCallbackUrl' => $this->getSuccessReturnUrl(),
                'tradeAmount'        => $this->getTradeAmount(),
                'tradeDescription'   => $this->getTradeDescription(),
                'tradeName'          => $this->getTradeName(),
                'tradeNum'           => $this->getTradeNum(),
                'tradeTime'          => $this->getTradeTime(),
                'version'            => $this->getVersion(),
                'token'              => $this->getToken(),
            );
            $data['merchantSign']       = $this->getMerchantSign($data);
        } else {
            $data = array(
                'currency'           => $this->getCurrency(),
                'failCallbackUrl'    => $this->getFailReturnUrl(),
                'merchantNum'        => $this->getMchId(),
                'merchantRemark'     => $this->getMerchantRemark(),
                'notifyUrl'          => $this->getNotifyUrl(),
                'successCallbackUrl' => $this->getSuccessReturnUrl(),
                'tradeAmount'        => $this->getTradeAmount(),
                'tradeDescription'   => $this->getTradeDescription(),
                'tradeName'          => $this->getTradeName(),
                'tradeNum'           => $this->getTradeNum(),
                'tradeTime'          => $this->getTradeTime(),
                'version'            => $this->getVersion(),
                'token'              => $this->getToken(),
            );
            $data['merchantSign']       = $this->getMerchantSign($data);
            $data['merchantRemark']     = DesHelper::encrypt($data['merchantRemark'], $this->getDesKey());
            $data['tradeNum']           = DesHelper::encrypt($data['tradeNum'], $this->getDesKey());
            $data['tradeName']          = DesHelper::encrypt($data['tradeName'], $this->getDesKey());
            $data['tradeDescription']   = DesHelper::encrypt($data['tradeDescription'], $this->getDesKey());
            $data['tradeTime']          = DesHelper::encrypt($data['tradeTime'], $this->getDesKey());
            $data['tradeAmount']        = DesHelper::encrypt($data['tradeAmount'], $this->getDesKey());
            $data['currency']           = DesHelper::encrypt($data['currency'], $this->getDesKey());
            $data['notifyUrl']          = DesHelper::encrypt($data['notifyUrl'], $this->getDesKey());
            $data['successCallbackUrl'] = DesHelper::encrypt($data['successCallbackUrl'], $this->getDesKey());
            $data['failCallbackUrl']    = DesHelper::encrypt($data['failCallbackUrl'], $this->getDesKey());
        }
        
        return $data;
    }

    public function getTradeDescription()
    {
        return $this->getParameter('trade_description');
    }

    public function setTradeDescription($trade_description)
    {
        return $this->setParameter('trade_description', $trade_description);
    }

    public function getTradeName()
    {
        return $this->getParameter('trade_name');
    }

    public function setTradeName($trade_name)
    {
        return $this->setParameter('trade_name', $trade_name);
    }

    public function getTradeTime()
    {
        return date('Y-m-d H:i:s');
    }

    public function getMerchantSign($param)
    {
        if ($this->getTradeType() == 'web') {
            return SignHelper::signWithoutToHex($param);
        } else {
            $sign = SignHelper::sign($param);
        }
    }

    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
