<?php

namespace Omnipay\JDPay\Message;

class RefundRequest extends BaseAbstractRequest
{
    protected $endpoint = 'https://m.jdpay.com/wepay/refund';
}
