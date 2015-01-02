@extends('layouts.juries-master')

@section('pagetitle')
	<title>Logs and events</title>
@stop

@section('content')
	<section class="panel">
		<header class="panel-heading">Stripe events</header>
		{{ $events }}
	</section>
@stop