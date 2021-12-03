

<?php
require('session/SessionCheckAdmin.php');
include "head.inc.php";
?>
 
<style type="text/css">
    .btnAdd {
      text-align: right;
      width: 83%;
      margin-bottom: 20px;
    }
  </style>
<body>
   <?php
        include "nav.inc.php";
        ?>
  <div class="container-fluid">
    <h2 class="text-center">User Management</h2>
    <div class="row">
      <div class="container">
        <div class="btnAdd">
         <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal"   class="btn btn-success btn-sm" >Add User</a>
       </div>
       <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
         <table id="example" class="table">
          <thead>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>    
            <th>Mobile Number</th>       
            <th>Admin</th>
            <th>Options</th>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
</div>
</div>
<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: Bootstrap Bundle with Popper -->
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/date-1.1.0/r-2.2.9/rg-1.1.3/sc-2.0.4/sp-1.3.0/datatables.min.js"></script>
<?php 
$usertype = 1; 
    ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "fnCreatedRow": function( nRow, aData, iDataIndex ) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide':'true',
        'processing':'true',
        'paging':'true',
        'order':[],
        'ajax': {
          'url':'fetch_data/fetch_data.php',
          'type':'post',
        },
        "columnDefs": [{
          'target':[7],
          'orderable' :false,
        }]
      });
    } );
    $(document).on('submit','#addUser',function(e){
      e.preventDefault();
      var username= $('#addUserField').val();
      var password= $('#addPasswordField').val();
      var fname= $('#addFirstnameField').val();
      var lname= $('#addLastnameField').val();
      var email= $('#addEmailField').val();
      var mobile= $('#addMobileField').val();
      //var admin= $('#addAdminField').val();
      
      
          
      //if(password != '' && username != '' && lname != '' && email != '' &&  fname != '' && admin!='')
      if(password != '' && username != '' && lname != '' && email != '')
      {
       $.ajax({
         url:"action/add_user.php",
         type:"post",
         data:{password:password,username:username,lname:lname,email:email,mobile:mobile,fname:fname},
         success:function(data)
         {
           var json = JSON.parse(data);
           var status = json.status;
           if(status=='true')
           {
            mytable =$('#example').DataTable();
            mytable.draw();
            $('#addUserModal').modal('hide');
          }
          else
          {
            alert('failed');
          }
        }
      });
     }
     else {
      alert('Fill all the required fields');
    }
  });
    $(document).on('submit','#updateUser',function(e){
      e.preventDefault();
       //var tr = $(this).closest('tr');
       var fname= $('#fnameField').val();
       var lname= $('#lnameField').val();
       var username= $('#unameField').val();
       var mobile= $('#mobileField').val();
       var email= $('#emailField').val();
       var password= $('#PasswordField').val();
       var trid= $('#trid').val();
       var id= $('#id').val();
       if(lname != '' && username != ''  && email != '' )
       {
         $.ajax({
           url:"action/update_user.php",
           type:"post",
           data:{lname:lname,username:username,mobile:mobile,email:email,id:id, fname:fname,password:password},
           success:function(data)
           {
             var json = JSON.parse(data);
             var status = json.status;
             if(status=='true')
             {
              table =$('#example').DataTable();
             
              var button =   '<td><a href="javascript:void();" data-id="' +id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' +id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='"+trid+"']");
              row.row("[id='" + trid + "']").data([id,username,email,fname,lname,mobile,usertype, button]);
              $('#exampleModal').modal('hide');
            }
            else
            {
              alert('failed');
            }
          }
        });
       }
       else {
        alert('Fill all the required fields');
      }
    });
    $('#example').on('click','.editbtn ',function(event){
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
     var id = $(this).data('id');
     $('#exampleModal').modal('show');

     $.ajax({
      url:"fetch_data/get_single_data.php",
      data:{id:id},
      type:'post',
      success:function(data)
      {
       var json = JSON.parse(data);
       
       $('#emailField').val(json.email);
       $('#mobileField').val(json.mobile_number);//database mobile_number column
       $('#fnameField').val(json.fname);
       $('#lnameField').val(json.lname);
       $('#unameField').val(json.uname); //database uname column
       //$('#PasswordField').val(json.password); //database password column name
        usertype =json.admin;
       $('#id').val(id);
       $('#trid').val(trid);
     }
   })
   });

    $(document).on('click','.deleteBtn',function(event){
       var table = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if(confirm("Are you sure want to delete this User ? "))
      {
      $.ajax({
        url:"action/delete_user.php",
        data:{id:id},
        type:"post",
        success:function(data)
        {
          var json = JSON.parse(data);
          status = json.status;
          if(status=='success')
          {
              
            //table.fnDeleteRow( table.$('#' + id)[0] );
             //$("#example tbody").find(id).remove();
             //table.row($(this).closest("tr")) .remove();
             $("#"+id).closest('tr').remove();
             mytable =$('#example').DataTable();
            mytable.draw();
            $('#addUserModal').modal('hide');
              
             
          }
          else
          {
            alert('Failed');
            return;
          }
        }
      });
      }
      else
      {
        return null;
      }



    })
 </script>
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="updateUser" >
          <input type="hidden" name="id" id="id" value="">
          <input type="hidden" name="trid" id="trid" value="">
          <div class="mb-3 row">
            <label for="unameField" class="col-md-3 form-label">Username</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="unameField" name="uname" >
            </div>
          </div>
          <div class="mb-3 row">
            <label for="emailField" class="col-md-3 form-label">Email</label>
            <div class="col-md-9">
              <input type="email" class="form-control" id="emailField" name="email">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="fnameField" class="col-md-3 form-label">First name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="fnameField" name="fname">
            </div>
          </div>
           <div class="mb-3 row">
            <label for="lnameField" class="col-md-3 form-label">Last name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="lnameField" name="lname">
            </div>
          </div>
           <div class="mb-3 row">
            <label for="PasswordField" class="col-md-3 form-label">Password</label>
            <div class="col-md-9">
              <input type="password" class="form-control" id="PasswordField" name="pwd" placeholder="Enter Password" >
            </div>
          </div>
          <div class="mb-3 row">
            <label for="mobileField" class="col-md-3 form-label">Mobile</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="mobileField" name="mobile">
            </div>
          </div>
         
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Add user Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addUser" action="">
          <div class="mb-3 row">
            <label for="addUserField" class="col-md-3 form-label">Username</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="addUserField" name="uname" placeholder="Enter your preferred Username" maxlength="15" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addEmailField" class="col-md-3 form-label">Email</label>
            <div class="col-md-9">
              <input type="email" class="form-control" id="addEmailField" name="email" placeholder="Enter Email" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addPasswordField" class="col-md-3 form-label">Password</label>
            <div class="col-md-9">
              <input type="password" class="form-control" id="addPasswordField" name="pwd" placeholder="Enter Password" required>
            </div>
          </div>
            <div class="mb-3 row">
            <label for="addFirstnameField" class="col-md-3 form-label">First Name</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="addFirstnameField" name="fname" placeholder="Enter First Name (Optional)" maxlength="45">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="addLastnameField" class="col-md-3 form-label">Last Name</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="addLastnameField" name="lname" placeholder="Enter Last Name" maxlength="45" required>
            </div>
          </div>
           <div class="mb-3 row">
            <label for="addMobileField" class="col-md-3 form-label">Mobile</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="addMobileField" name="mobile" placeholder="Enter Mobile Number (Optional)" maxlength="12" >
            </div>
          </div>
<!--             
           <div class="mb-3 row">
            <label for="addAdminField" class="col-md-3 form-label">Admin</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="addAdminField" name="admin" placeholder="Only required for admin" maxlength="2" >
            </div>
          </div>-->
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php 
include "footer.inc.php";
 ?>
</body>
</html>

