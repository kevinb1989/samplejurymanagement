<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
   <HEAD>
      <TITLE>All juries (Demo Page to test datatables</TITLE>
      @include('css_js')


      <script type="text/javascript">
         $(document).ready(function(){
         
            $("#juries-table").dataTable();
            alert('datatable rendered!');
            
         });
      </script>
   </HEAD>
   <BODY>
      <h3>All Juries</h3>
      <table id="juries-table" class='table table-striped table-bordered table-hover table-condensed'>
      	<thead>
            <tr>
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
                  <td> {{$jury -> id}} </td>
                  <td> {{ $jury -> FirstName }} </td>
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
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </BODY>
</HTML>