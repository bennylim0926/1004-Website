<?php
session_start();
include('session/SessionCheckUser.php');
       $userID = $_SESSION["userID"];
      require('Connection/connection.php');  
          

    // Retrieves user info from database
     $stmt = $conn->prepare("SELECT * FROM accounts WHERE acc_id=?");
     $stmt->bind_param("s", $userID);
        if (!$stmt->execute())
      {
          echo "<h2>Execute failed: (' . $stmt->errno . ') ' . $stmt->error</h2>";
          echo "<h2>Please try again</h2>";
          exit();
      }
      $result = $stmt->get_result();
      $stmt->close();
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
                        <div class="col-sm-5 col-md-3 text-center" id="change-pic">
                            <img class="avatar2" src="<?=$user_details["photo"]?>" alt="Profile Picture">
                            <p class="h5"><?=$user_details["uname"]?></p>
                            <p class="h6"><?=$user_details["email"]?></p>
                        </div>
                        <div class="col-sm-7 col-md-9 my-4">
                            <div class="form-group">
                                <label for="file_upload">Change Profile Picture</label>
                                <input type="file" class="form-control-file" id="file_upload" name="file_upload" accept=".jpeg,.jpg,.png">
                            </div>
                            <div class="form-group">
                                <label for="username">New Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"></div>
                                    </div>
                                    <input class="form-control" type="text" id="username" name="username" placeholder="Enter new username" maxlength="15">
                                </div>
                                <small class="form-text text-muted">
                                    Username must be unique and contain no more than 15 alphanumeric characters.
                                </small>
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
                                <input class="form-control" type="password" id="pwd" name="new_pwd" minlength="3" placeholder="Enter new password">
                                <small class="form-text text-muted">
                                    Your password must be at least 8 characters long, contain upper and lowercase letters, and include numbers.
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="pwd_confirm">Confirm Password</label>
                                <input class="form-control" type="password" id="pwd_confirm" name="pwd_confirm" minlength="3" placeholder="Re-enter new password">
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