<?php

namespace Omnipay\JDPay\Message;

class PurchaseRequest extends BaseAbstractRequest
{
    protected $endpoint = array(
        'web'    => 'https://plus.jdpay.com/nPay.htm',
        'mobile' => 'https://m.jdpay.com/wepay/web/pay',
    );
}
