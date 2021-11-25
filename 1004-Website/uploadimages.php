<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['uname'])) { //if login in session is not set
    header("Location: 401.php");
    exit();
}
?>
    
<!DOCTYPE html>
<html>
  
 <?php
        include "head.inc.php";
        ?>
  
<body>
        <?php include "nav.inc.php"; ?>
     <main class="container">
    <div id="form-group">
  
        <form method="POST" 
              action="" 
              enctype="multipart/form-data">
            <input type="file" 
                   name="uploadfile" 
                   value="" />
  
            <div>
                <button type="submit"
                        name="upload">
                  UPLOAD
                </button>
            </div>
        </form>
    </div>
          </main>
    
</body>
  
</html>


                