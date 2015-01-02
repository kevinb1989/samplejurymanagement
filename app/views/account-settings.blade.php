@extends('layouts.juries-master')

@section('pagetitle')
   <TITLE>Account Settings</TITLE>
@stop

@section('content')
      <section class="panel">
         <header class="panel-heading">Subscription Plan</header>
          <div class="panel-body">
            @if($user -> subscribed())
              @if(!$user -> cancelled())
                <p><b>Your plan: </b>{{ $user -> getStripePlan() }}</p>
                <?php 
                 
                ?>
                <p><b>Next billing date: </b>{{ $upcomingBillingDate }}</p>
                <p>{{ link_to('download-invoice', 'download the invoice', array('class' => 'btn btn-success')) }}
                  {{ link_to('cancel-subscription', 'cancel your subscription', array('class' => 'btn btn-danger')) }}
                </p>
              @else
                <p>You have canceled your subscription of <b>{{ $user -> getStripePlan() }}</b></p>
                {{ link_to('resume-subscription', 'resume your subscription', array('class' => 'btn btn-success')) }}
              @endif
            @else
                <p>You haven't subscribed to any plan yet, {{ link_to('subscribe', 'click here') }} to become a sponsored professional or to test the one-day plan.</p>
            @endif
      
          </div>
      </section>
@stop



@section('customscript')
@stop