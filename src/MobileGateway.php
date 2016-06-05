<?php

namespace Omnipay\JDPay;

class MobileGateway extends BaseAbstractGateway
{
    public function getName()
    {
        return 'JDPay_Mobile';
    }

    public function getTradeType()
    {
        return 'mobile';
    }
}
