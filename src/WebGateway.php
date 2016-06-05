<?php

namespace Omnipay\JDPay;

class WebGateway extends BaseAbstractGateway
{
    public function getName()
    {
        return 'JDPay_Web';
    }

    public function getTradeType()
    {
        return 'web';
    }
}
