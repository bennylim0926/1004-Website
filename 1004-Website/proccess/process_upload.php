<?php
session_start();
// Define and initialize variables to hold our form data:
$base64 = $caption = $errorMsg = "";
$success = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["b64"] == "") {
        $errorMsg = "You did not upload any image!";
        $success = false;
    } else {
        $base64 = $_POST["b64"];
    }
    $caption = sanitize_input($_POST["caption"]);

    if ($success) {
        saveImageToDB();
    }
} else {
    echo "<h2>Oops. This page is not meant to be run directly.</h2>";
    echo "<a href='index.php'>Go to Sign up page...</a>";
    exit();
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function saveImageToDB() {
    global $base64, $caption, $errorMsg, $success;
    // Create database connection.
    $curDateTime = date("Y-m-d H:i:s");
    $config = parse_ini_file('../../private/dbconfig.ini');
    $conn = new mysqli($config['servername'], $config['username'],$config['password'], 'ITshop');
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the statement:
        $stmt = $conn->prepare("INSERT INTO image (acc_id, base64, caption, upload_date) VALUES (?, ?, ?, ?)");

        // Bind & execute the query statement:
        $stmt->bind_param("ssss", $_SESSION['acc_id'], $base64, $caption, $curDateTime);
        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<html lang="en">
    <head>
        <title>Image Upload Result</title>
        <?php
        include "head.inc.php";

        if ($success) {
            ?>
            <meta http-equiv="refresh" content="5;url=uploadimages.php?id=<?php echo $_SESSION['uname'] ?>" />
            <?php
        } else {
            ?>
            <meta http-equiv="refresh" content="5;url=uploadimages.php" />
            <?php
        }
            ?>
        </head>
        <body>
            <main class="container">

                <?php
                if ($success) {
                    echo "<h3>Your image has been uploaded!</h3>";
                    echo "<p>You will be redirected in 3 seconds...</h3>";
                } else {
                    echo "<h3>Oops!</h3>";
                    echo "<h4>The following input errors were detected:</h4>";
                    echo "<p>" . $errorMsg . $base64 . "</p>";
                    echo "<a class=\"btn btn-danger\" href=\"uploadimages.php\">Return to Upload Image</a>";
                }
                ?>

            </main>
            <?php
            include "footer.inc.php";
            ?>
    </body>
</html>