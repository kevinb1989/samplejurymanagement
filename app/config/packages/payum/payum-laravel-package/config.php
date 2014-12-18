<?php

use Payum\Core\Storage\FilesystemStorage;
use Payum\Paypal\ExpressCheckout\Nvp\Api;
use Payum\Paypal\ExpressCheckout\Nvp\PaymentFactory as PaypalPaymentFactory;

$detailsClass = 'Payum\Core\Model\ArrayObject';
$tokenClass = 'Payum\Core\Model\Token';

$paypalPayment = PaypalPaymentFactory::create(new Api(array(
    'username' => 'hoanglongbui89-facilitator_api1.yahoo.com.vn',
    'password' => 'XRJKYT4RXLXWXSTB',
    'signature' => 'A.T8344Tbq651WJBel24-jTgfyjNA6WSO2faTjFk1MHobqCLQL65APWP',
    'sandbox' => true
)));

return array(
    // You can pass on object or a service id from container.
    'token_storage' => new FilesystemStorage(__DIR__.'/../../../../storage/payments', $tokenClass, 'hash'),
    'payments' => array(
        // Put here any payment you want too, omnipay, payex, paypa, be2bill or any other. Here's example of paypal and stripe:
    ),
    'storages' => array(
        $detailsClass => new FilesystemStorage(__DIR__.'/../../../../storage/payments', $detailsClass),
    )
);