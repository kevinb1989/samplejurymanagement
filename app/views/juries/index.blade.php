@extends('layouts.juries-master')

@section('pagetitle')
   <TITLE>All juries</TITLE>
@stop

@section('content')
   <h3>Search</h3>
      <hr>
      {{ Form::open(array('name' => 'jury-search-frm', 'id' => 'jury-search-frm', 'role' => 'form', 'class' => 'form-inline')) }}
         <div class="form-group">
            {{ Form::label('First name:') }}
            {{ Form::text('first_name', '', array('class' => 'form-control', 'id' => 'first_name')) }}
         </div>
         <div class="form-group">
            {{ Form::label('Last name:') }}
            {{ Form::text('last_name', '', array('class' => 'form-control', 'id' => 'last_name')) }}
         </div>
         <div class="form-group">
            {{ Form::submit('Search', array('class' => 'btn btn-success')) }}
            {{ Form::reset('Reset', array('class' => 'btn btn-danger')) }}
         </div>

      {{ Form::close() }}
      <h3>All Juries</h3>
      <hr>
      {{ Form::open(array('url' => 'massdelete', 'method' => 'post', 'id' => 'multiple-delete-frm')) }}
         <table id="juries-table" class='table table-striped table-bordered table-hover table-condensed'>
         <thead>
            <tr>
               <th>Selected</th>
               <th>Jury ID</th>
               <th>First Name</th>
               <th>Last Name</th>
               <th>Email</th>
               <th>Country</th>
               <th>Total Voted Apps</th>
               <th>Enabled</th>
               <th>Edit</th>
               <th>Delete</th>
            </tr>
         </thead>
         <tbody>
            @foreach($juries as $jury)
               <tr>
                  <td>
                     <div class="checkboxes">
                        <label class="label_check" for="jury-cbx-{{$jury -> id}}">
                           {{ Form::checkbox('all-juries[]', $jury -> id, false, array('id' => 'jury-cbx-' . $jury -> id)) }}
                           &nbsp;
                        </label>
                     </div>
                  </td>
                  <td> {{$jury -> id}} </td>
                  <td> {{ link_to_route('juries.edit', $jury -> FirstName , array($jury -> id)) }} </td>
                  <td> {{ $jury -> LastName }} </td>
                  <td> {{ $jury -> Email}} </td>
                  <td> {{ $jury -> Country }} </td>
                  <td> {{ $jury -> TotalVotedApps }} </td>
                  <td> 
                     @if($jury -> Enabled)
                        {{ 'Enabled' }}
                     @else
                        {{ 'Disabled' }}
                     @endif
                  </td>
                  <td>
                     {{ link_to_route('juries.edit', 'Edit', array($jury -> id), array('class' => 'btn btn-success')) }}
                  </td>
                  <td>
                     {{ Form::open(array('method' => 'DELETE', 'route' => array('juries.destroy', $jury->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger delete-btn-cls')) }}
                     {{ Form::close() }}
                     <!-- Jeffrey's method -->
                     <!-- <a href="juries/{{ $jury -> id }}" data-method="delete" data-confirm="Are you sure?" class="btn btn-danger">Delete -->
                     </a>
                  </td>
               </tr>
            @endforeach
            
         </tbody>
      </table>
      <p>{{ link_to_route('juries.create', 'Create a new jury', array(), array('class' => 'btn btn-success')) }}
      {{ Form::submit('Delete selected juries', array('id' => 'delete-all-btn', 'class' => 'btn btn-danger')) }}
      {{ Form::close() }}   
      </p>
@stop

@section('customscript')
   <script type="text/javascript">
         $(document).ready(function(){
         
            juriesTable = $("#juries-table").dataTable();

            $("#jury-search-frm").bind("submit", function(){
               var searchFirstName = $("#first_name").val();
               var searchLastName = $("#last_name").val();
               juriesTable.fnFilter(searchFirstName,2);
               juriesTable.fnFilter(searchLastName,3);
               return false;
            });

            $("#jury-search-frm").bind("reset", function(){
               juriesTable.fnFilterClear();
            });
            
            $(".delete-btn-cls").bind('click', function(){
               if(!confirm("you want to remove this jury?")){
                  return false;
               }
            });

            $("#multiple-delete-frm").bind('submit', function(){
               var oTable = $('#juries-table').dataTable();
               var sData = jQuery('input:checked', oTable.fnGetNodes()).serialize();
               if(sData.length != 0){
                  if(!confirm("you really want to remove the selected juries?")){
                  return false;
                     }else{
                        deleterows(sData, oTable);
                        return false;
                     }
               }else{
                  alert("No jury is selected.");
                  return false;
               }
                  
            });
            
         });

         function deleterows(sData, oTable){
               //remove selected rows from the table
               var aTrs = oTable.fnGetNodes();
               for ( var i=0 ; i<aTrs.length ; i++ ){
                  if(jQuery('input:checked', aTrs[i]).val()){
                     oTable.fnDeleteRow(aTrs[i]);
                  }
               }
            
            //make an AJAX call and delete those juries from db
               $.ajax({
                       type: "POST",
                       url : "massdelete",
                       data : sData,
                       success : function(data){
                           //console.log(data);
                           alert(data);
                  }
               },"json");
         }
      </script>
@stop
