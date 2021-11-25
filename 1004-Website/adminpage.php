<?php include('connection.php');
include('../Session/SessionCheckAdmin.php');
?>
 
<head>
    
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/date-1.1.0/r-2.2.9/rg-1.1.3/sc-2.0.4/sp-1.3.0/datatables.min.css"/>
  <title>Server Side CRUD Ajax Operations</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
  <style type="text/css">
    .btnAdd {
      text-align: right;
      width: 83%;
      margin-bottom: 20px;
    }
  </style>

  
</head>

<body>
   <nav class="navbar navbar-expand-sm navbar-dark bg-dark" >
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01" >
        <a class="navbar-brand" href="index.php"><img src="images/dogeLogo.jfif" alt="Logo" title="Logo" width="86" height="103"/></a>
        <ul class="navbar-nav" >
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=index.php#dogs">Dogs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php#cats">Cats</a>
            </li>                   
        </ul>
        <ul class="navbar-nav  ms-auto mb-2 mb-lg-0">
            <li>
                   <?php
                if (isset($_SESSION["uname"])) {
                    echo "<li class='nav-item'> <a class='nav-link'><span class='material-icons'>account_box</span> Welcome back, " . $_SESSION["uname"] . "</a></li>";                
                    echo "<li class='nav-item'> <a class='nav-link' href='account.php'><span class='material-icons'>account_circle</span>Edit Account</a></li>";
                     if (($_SESSION['admin']) == true)  
                    {
                       echo "<li class='nav-item'> <a class='nav-link' href='adminpage.php'><span class='material-icons'>account_circle</span>User management</a></li>"; 
                    }         
                    echo "<li class='nav-item'> <a class='nav-link' href='uploadimages.php'><span class='material-icons'>account_circle</span>Upload Images</a></li>";
                    echo "<li class='nav-item'> <a class='nav-link' href='logout.php'><span class='material-icons'>logout</span>Logout</a></li>";
                   
                    
                } 
                else 
                { ?>
                    <li class="nav-item">
                         <a class="nav-link" href="register.php"><span class="material-icons">account_circle</span>Register</a> 
                     </li>
                    <li class="nav-item">
                         <a class="nav-link" href="login.php"><span class="material-icons">login</span>Login</a> 
                     </li>
                     
            <?php
                }
            ?>
                
            </li>
        </ul>
    </div>
</nav>   
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
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Last Name</th>
            <th>First Name</th>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/af-2.3.7/date-1.1.0/r-2.2.9/rg-1.1.3/sc-2.0.4/sp-1.3.0/datatables.min.js"></script>

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
          'url':'fetch_data.php',
          'type':'post',
        },
        "columnDefs": [{
          'target':[5],
          'orderable' :false,
        }]
      });
    } );
    $(document).on('submit','#addUser',function(e){
      e.preventDefault();
      var password= $('#addPasswordField').val();
      var username= $('#addUserField').val();
      var lname= $('#addLastnameField').val();
      var email= $('#addEmailField').val();
      if(password != '' && username != '' && lname != '' && email != '' )
      {
       $.ajax({
         url:"add_user.php",
         type:"post",
         data:{password:password,username:username,lname:lname,email:email},
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
       var lname= $('#lnameField').val();
       var username= $('#unameField').val();
       var mobile= $('#mobileField').val();
       var email= $('#emailField').val();
       var trid= $('#trid').val();
       var id= $('#id').val();
       if(lname != '' && username != '' && mobile != '' && email != '' )
       {
         $.ajax({
           url:"update_user.php",
           type:"post",
           data:{lname:lname,username:username,mobile:mobile,email:email,id:id},
           success:function(data)
           {
             var json = JSON.parse(data);
             var status = json.status;
             if(status=='true')
             {
              table =$('#example').DataTable();
              // table.cell(parseInt(trid) - 1,0).data(id);
              // table.cell(parseInt(trid) - 1,1).data(username);
              // table.cell(parseInt(trid) - 1,2).data(email);
              // table.cell(parseInt(trid) - 1,3).data(mobile);
              // table.cell(parseInt(trid) - 1,4).data(city);
              var button =   '<td><a href="javascript:void();" data-id="' +id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' +id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='"+trid+"']");
              row.row("[id='" + trid + "']").data([id,username,email,mobile,lname, button]);
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
      url:"get_single_data.php",
      data:{id:id},
      type:'post',
      success:function(data)
      {
       var json = JSON.parse(data);
       
       $('#emailField').val(json.email);
       $('#mobileField').val(json.mobile);
       $('#lnameField').val(json.lname);
       $('#unameField').val(json.username);
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
        url:"delete_user.php",
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
            <label for="mobileField" class="col-md-3 form-label">Mobile</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="mobileField" name="mobile">
            </div>
          </div>
          <div class="mb-3 row">
            <label for="lnameField" class="col-md-3 form-label">Last name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="lnameField" name="lname">
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
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addUser" action="">
          <div class="mb-3 row">
            <label for="addUserField" class="col-md-3 form-label">Username</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="addUserField" name="uname" placeholder="Enter your preferred Username" maxlength="45" required>
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
            <label for="addLastnameField" class="col-md-3 form-label">Last Name</label>
            <div class="col-md-9">
               <input type="text" class="form-control" id="addLastnameField" name="lname" placeholder="Enter Last Name" maxlength="45" required>
            </div>
          </div>
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
</body>
</html>

