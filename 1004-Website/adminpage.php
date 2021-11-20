<?php
session_start();
//  CHECK IF ADMIN IS SIGNED IN
if (($_SESSION['admin']) == false)  
{ 
    header("Location: 401.php");
    exit();
    die("Unauthorized");//terminate script
}

if (!isset($_SESSION['uname'])) 
{ //if login in session is not set
    header("Location: 401.php");
    exit();
}
?>

<?php
    include "head.inc.php";
?>
<body>
    <?php
        include "nav.inc.php";
    ?>
    
    <main class="container">
        <h1>Delete User account using Ajax</h1>
        
        <form action="process_account_edit.php" class="sign-in-form" method="POST">
            <div class="form-group">
                <label for="edit_pwd">
                    Old Password:
                </label>
               <input type="password" aria-label="Not ready." id="edit_pwd" name="edit_pwd">
            </div>
            
            <div class="form-group">
                <label for="edit_npwd">New Password:</label>
                <input type="password" aria-label="Enter your new password." id="edit_npwd" name="edit_npwd">
            </div>
            
            <div class="form-group">  
                 <label for="edit_cpwd">Confirm New Password:</label>
                <input type="password" aria-label="Confirm your new password." id="edit_cpwd" name="edit_cpwd">
            </div>
            
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </main>
    
    <?php
        include "footer.inc.php";
    ?>
</body>
