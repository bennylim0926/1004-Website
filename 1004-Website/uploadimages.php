<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['uname'])) { //if login in session is not set
    header("Location: 401.php");
    exit();
}
?>

<html lang="en">

        <?php
        include "head.inc.php";
        ?>
   
    <body class="w3-light-grey w3-content">
        <?php include "nav.inc.php"; ?>
        <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()">
            <i class="fa fa-bars"></i>
        </span>
        
        <header class="jumbotron text-center">
            <h1 class="w3-center mainheader" >Upload Image</h1>
        </header>
    <main class="container">
        <form action="process_upload.php" class="upload_image" method="POST">
                            <label for="uploader">Select a file:</label>
                            <input type="file" id="uploader" accept=".jpg, .png, .jpeg">
                            <input type="hidden" id="b64" name="b64" value=""/>
                            <button class="contactUsBtn" id="uploadBtn" type="submit">Upload</button>
        </form>
    </main>
        
        <div class="w3-main" >
            <div class="w3-container w3-padding-64  w3-light-blue w3-grayscale-min" id="us">
                <div class="w3-content">             
                    <?php
                    include "footer.inc.php";
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>



                