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


}
