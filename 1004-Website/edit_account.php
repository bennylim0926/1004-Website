<?php
session_start();
    require('session/SessionCheckUser.php');
       $userID = $_SESSION["userID"];
      require('Connection/connection.php');  
          

    // Retrieves user info from database
     $stmt = $conn->prepare("SELECT * FROM accounts WHERE acc_id=?");
     $stmt->bind_param("s", $userID);

     include('Connection/handle_sql_execute_failure.php');
      $conn->close();     

    $user_details = $result->fetch_assoc();
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include "head.inc.php";
        ?>
        <script defer src="js/form_validation.js"></script>
        <title>Edit Profile</title>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <?php
        include "nav.inc.php";
        ?>
        <main class="container flex-grow-1">
            <h1 class="display-4 mt-4">Edit Profile</h1>
            <hr>
            <div>
                <form action="/1004-Website/process/process_edit_account.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-5 col-md-3 text-left" id="change-pic">
                            <img class="avatar2" src="<?=$user_details["photo"]?>" alt="Profile Picture">
                            
                            <table class="table table-bordered" >
                            
                              <tr>
                                <th>Username:</th>
                                <th><?=$user_details["uname"]?></th>  
                              </tr>
                             
                              <tr>
                                <th>Email:</th>
                                <th><?=$user_details["email"]?></th>

                              </tr>
                              <tr>
                                <th>Mobile number:</th>
                                <th><?=$user_details["mobile_number"]?> </th>

                              </tr>                      
                          </table>
                          

                        </div>
                        <div class="col-sm-7 col-md-9 my-4">
                            <div class="form-group">
                                <label for="file_upload">Change Profile Picture</label>
                                <input type="file" class="form-control-file" id="file_upload" name="file_upload" accept=".jpeg,.jpg,.png">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <div class="input-group">
<!--                                    <div class="input-group-prepend">                                      
                                        <div class="input-group-text">Current</div>
                                    </div>-->
                                    <input class="form-control" type="text" alt="UsernameField" id="username" name="username" placeholder=<?=$user_details["uname"]?> maxlength="15">
                                </div>
                                <small class="form-text text-muted">
                                    Username must be unique and contain no more than 15 alphanumeric characters(No white space allowed).
                                </small>
                            </div>
                            <div class="form-group">
                            <label for="email" >Email</label>  
                            <div class="input-group">    
                               <input type="email" class="form-control" id="email" name="email" placeholder=<?=$user_details["email"]?> maxlength="45" >        
                          </div>
                            </div>
                             <div class="form-group">
                            <label for="mobile" >Mobile</label>
                            <div class="input-group">       
                               <input type="text" class="form-control" id="mobile" name="mobile" placeholder=<?=$user_details["mobile_number"]?> maxlength="12" >
                            </div>
                          </div>
                            <div class="form-group">
                                <label for="old_pwd">Old Password</label>
                                <input class="form-control" type="password" id="old_pwd" name="old_pwd" minlength="3" placeholder="Enter old password">
                                <small class="form-text text-muted">
                                    You have to enter your old password before you can change your password.
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="pwd">New Password</label>
                                <input class="form-control" type="password" id="pwd" name="new_pwd" minlength="6" placeholder="Enter new password">
                                <small class="form-text text-muted">
                                    Your password must be at least 6 characters long, with at least 1 letter and number.
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="pwd_confirm">Confirm Password</label>
                                <input class="form-control" type="password" id="pwd_confirm" name="pwd_confirm" minlength="6" placeholder="Re-enter new password">
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        
        <?php
        include "footer.inc.php";
        unset($result, $userID, $user_details);
        ?>
    </body>
</html>