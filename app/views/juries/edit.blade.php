@extends('layouts.juries-master')

@section('pagetitle')
    <TITLE>Edit a jury</TITLE>
@stop

@section('content')
   <section class="panel">
      <header class="panel-heading">Edit a jury</header>     
      <div class="panel-body">
         {{ Form::open(array('route' => 'juries.update', 'id' => 'edit-jury-frm', 'role' => 'form', 'class' => 'form-horizontal')) }}
         {{ Form::hidden('_method', 'put') }}
         {{ Form::hidden('jury_id', $jury -> id) }}
         <div class="form-group"> 
            {{ Form::label('first_name', 'First name: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }}
            <div class="col-lg-10">
               {{ Form::text('first_name', $jury -> FirstName, array('id' => 'first_name', 'class' => 'form-control')) }} 
            </div>
         </div>
         <div class="form-group">
            {{ Form::label('last_name', 'Last name: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }}
            <div class="col-lg-10">
               {{ Form::text('last_name', $jury -> LastName, array('id' => 'last_name', 'class' => 'form-control')) }} 
            </div>
         </div>
         <div class="form-group"> 
            {{ Form::label('email', 'Email: ', array('class' => 'col-lg-2 col-sm-2 control-label')) }}
            <div class="col-lg-10">
               {{ Form::text('email', $jury -> Email, array('id' => 'email', 'class' => 'form-control')) }} 
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
               ),$jury -> Country, array('id' => 'country', 'class' => 'form-control')) }} 
            </div>
         </div>
         <div class="form-group"> 
            <div class="col-lg-offset-2 col-lg-10">
               <div class="checkbox">
                  <label>
                     {{ Form::checkbox('enabled', 'enabled', $jury -> Enabled, array('id' => 'enabled')) }} 
                     Enabled
                  </label>
               </div>
            </div>
         </div>
         <p> {{ Form::submit('Update', array('class' => 'btn btn-sm btn-success')) }} {{ link_to_route('juries.index', 'Back', array(), array('class' => 'btn btn-sm btn-danger')) }} </p>
         {{ Form::close() }}   
      </div> 
      
   </section>
   x`
@stop

@section('customscript')
   <script type="text/javascript">
         $(document).ready(function(){
            $("#edit-jury-frm").validate({
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