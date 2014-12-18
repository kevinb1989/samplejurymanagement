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
      			<tr>
      				<td>1</td>
      				<td>Hoang Long</td>
      				<td>Bui</td>
      				<td>hoanglongbui89@yahoo.com.vn</td>
      				<td>Vietnam</td>
                  <td>17</td>
                  <td>Enabled</td>
      				<td>
                     <a href="#" class="btn btn-sm btn-success">Edit</a>
                  </td>
                  <td>
                     <a href="#" class="btn btn-sm btn-danger">Delete</a>
                  </td>
      			</tr>
               <tr>
                  <td>2</td>
                  <td>Minh Tien</td>
                  <td>Nguyen</td>
                  <td>minhtien.swin@gmail.com</td>
                  <td>Vietnam</td>
                  <td>17</td>
                  <td>Disabled</td>
                  <td>
                     <a href="#" class="btn btn-sm btn-success">Edit</a>
                  </td>
                  <td>
                     <a href="#" class="btn btn-sm btn-danger">Delete</a>
                  </td>
               </tr>
      	</tbody>
      </table>
   </BODY>
</HTML>