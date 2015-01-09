<?php

class MyWebhookController extends Laravel\Cashier\WebhookController {
	/**
	 * Determine if the invoice has too many failed attempts.
	 * Maximum number of failed attempts have been reduced to 1 for the purpose of testing
	 *
	 * @param  array  $payload
	 * @return bool
	 */
	protected function tooManyFailedPayments(array $payload)
	{
		return $payload['data']['object']['attempt_count'] > 0;
	}

	/**
	 * Handle a failed payment from a Stripe subscription.
	 * if both Stripe and Cashier attempt to cancel the subscription at the same time it will failed on client side
	 * So we only need to update our db.
	 *
	 * @param  array  $payload
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	protected function handleInvoicePaymentFailed(array $payload)
	{
		if ($this->tooManyFailedPayments($payload))
		{
			$billable = $this->getBillable($payload['data']['object']['customer']);

			if ($billable){
				//$billable->subscription()->cancel();	
				$billable -> stripe_active = 0;
				$billable -> subscription_ends_at = date('Y-m-d H:i:s');
				$billable -> save();
			} 
		}

		return new Symfony\Component\HttpFoundation\Response('Webhook Handled', 200);
	}


}
