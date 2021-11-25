 <?php
session_start();
include('../Session/SessionCheckUser.php');
?>
<?php
    include "head.inc.php";
?>
<body>
    <?php
        include "nav.inc.php";
    ?>
    
    <main class="container">
        <h1>Change Account Password</h1>
        
        <form action="process_account_edit.php" class="sign-in-form" method="POST">
            <div class="form-group">
                <label for="edit_pwd">
                    Old Password:
                </label>
               <input type="password" aria-label="Enter your old password." id="edit_pwd" name="edit_pwd">
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
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </main>
    
    <?php
        include "footer.inc.php";
    ?>
</body>
