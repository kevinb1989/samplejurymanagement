@extends('layouts.juries-master')

@section('pagetitle')
	<title>become a sponsored pro</title>
@stop

@section('content')
	<section class="panel">
		<header class="panel-heading">Become a sponsored pro</header>
		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="CW92LVG24R6K6">
			<input type="image" src="https://www.sandbox.paypal.com/en_AU/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal — The safer, easier way to pay online.">
			<img alt="" border="0" src="https://www.sandbox.paypal.com/en_AU/i/scr/pixel.gif" width="1" height="1">
		</form>
	</section>
@stop