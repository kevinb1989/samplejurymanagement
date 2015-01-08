<?php

class MyWebhookController extends Laravel\Cashier\WebhookController {

	/**
	 * Overide missingMethod from WebhookController to test Stripe Webhook
	 *
	 * @param  array   $parameters
	 * @return mixed
	 */
	public function missingMethod($parameters = array())
	{
		return new Response('Handling method is missing', 200);;
	}

}
