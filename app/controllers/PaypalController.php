<?php

class PaypalController extends \BaseController {

	public function prepareExpressCheckout(){
        $storage = \App::make('payum')->getStorage('Payum\Core\Model\ArrayObject');

        $details = $storage->createModel();
        $details['PAYMENTREQUEST_0_CURRENCYCODE'] = 'EUR';
        $details['PAYMENTREQUEST_0_AMT'] = 1.23;
        $storage->updateModel($details);

        $captureToken = \App::make('payum.security.token_factory')->createCaptureToken('paypal_es', $details, 'payment_done');

        return \Redirect::to($captureToken->getTargetUrl());
    }


}
