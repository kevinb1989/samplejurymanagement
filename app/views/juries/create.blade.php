@extends('layouts.juries-master')

@section('pagetitle')
   <TITLE>Create a new jury</TITLE>
@stop

@section('content')
      <section class="panel">
         <header class="panel-heading">Create a Jury</header>
         <div class="panel-body">
            {{ Form::open(array('route' => 'juries.store', 'role' => 'form', 'class' => 'form-horizontal', 'id' => 'create-jury-frm')) }}
         <div class="form-group">
               {{ Form::label('first_name', 'First name: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }} 
            <div class="col-lg-10">
               {{ Form::text('first_name', '',  array('id' => 'first_name', 'class' => 'form-control'))}}
            </div>
            
         </div>
         <div class="form-group">
            {{ Form::label('last_name', 'Last name: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }} 
            <div class="col-lg-10">
               {{ Form::text('last_name', '', array('id' => 'last_name', 'class' => 'form-control')) }}
            </div>
            
         </div>
         <div class="form-group">
            {{ Form::label('email', 'Email: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }} 
            <div class="col-lg-10">
               {{ Form::text('email', '', array('id' => 'email', 'class' => 'form-control')) }}
            </div>
         </div>
      <div class="form-group">
         {{ Form::label('country', 'Country: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }} 
         <div class="col-lg-10">
            {{ Form::select('country', array(
            "Australia" => "Australia",
            "India" => "India",
            "China" => "China",
            "Pakistan" => "Pakistan",
            "Hong Kong" => "Hong Kong",
            "Vietnam" => "Vietnam",
            "India" => "India",
            "USA" => "USA",
         ), 'Australia' , array('id' => 'email', 'class' => 'form-control')) }} 
         </div>
      </div>
      <br>
      <p>
         {{ Form::submit('submit', array('class' => 'btn btn-sm btn-success')) }} {{ link_to_route('juries.index', 'Back', array(), array('class' => 'btn btn-sm btn-danger')) }}
      </p>
      {{ Form::close() }}
   </div>
         
   </section>
      
@stop

@section('customscript')
   <script type="text/javascript">
         $(document).ready(function(){
            $("#create-jury-frm").validate({
               rules: {
                  email: {
                  required: true,
                  email: true
                  },
                  first_name: {
                  required: true
                  },
                  last_name: {
                  required: true
                  }
               },
               messages: {
                     email: {
                        required: "<p><i>Please enter your email</i></p>",
                        email: "<p><i>This must be a valid email address</i></p>" 
                     }, 
                     first_name: "<p><i>Please enter first name</i></p>",
                     last_name: "<p><i>Please enter last name</i></p>"
               }
            });
         });
      </script>
@stop
