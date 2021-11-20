<?php
        include 'head.inc.php';
        
session_start();
// Define and initialize variables to hold our form data:
$email = $pwd_hashed = $old_password = $errorMsg = "";
$success = true;

// Only process if the form has been submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Password
    if (empty($_POST["edit_pwd"]) || empty($_POST["edit_npwd"]) || empty($_POST["edit_cpwd"])) {
        $errorMsg .= "Password and confirmation are required.<br>";
        $success = false;
    } else {
        // Make sure password match
        if ($_POST["edit_npwd"] != $_POST["edit_cpwd"]) {
            $errorMsg .= "New Password and Confirm Password do not match.<br>";
            $success = false;
        } else {
            $pwd_hashed = password_hash($_POST["edit_npwd"], PASSWORD_DEFAULT);
        }
    }

    saveMemberToDB();
} 
else 
{
    if (isset($_SESSION['user'])) {
        echo "<h2>This page is not meant to be run directly.</h2>";
        echo "<a href='account.php'>Go to My Account Page...</a>";
    } else {
        echo "<h2>This page is not meant to be run directly.</h2>";
        echo "<p>You can register at the link below:</p>";
        echo "<a href='index.php'>Go to Sign up page...</a>";
    }
    exit();
}

function saveMemberToDB() {
    global $email, $pwd_hashed, $old_password, $errorMsg, $success;

    // Create database connection.
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the statement:
        $stmt = $conn->prepare("SELECT password FROM world_of_pets_members WHERE email=?");

        // Bind & execute the query statement:
        $stmt->bind_param("s", $_SESSION['email']);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Note that email field is unique, so should only have
            // one row in the result set.
            $row = $result->fetch_assoc();
            $old_password = $row["password"];

            // Check if the password matches:
            if (!password_verify($_POST["edit_pwd"], $old_password)) {
                // Don't be too specific with the error message - hackers don't
                // need to know which one they got right or wrong. :)
                $errorMsg = "Incorrect password..";
                $success = false;
            } else {
                $stmt_change = $conn->prepare("UPDATE world_of_pets_members SET password=? WHERE email=?");
                $stmt_change->bind_param("ss", $pwd_hashed, $_SESSION['email']);
                if (!$stmt_change->execute()) {
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $success = false;
                }
                $stmt_change->close();
            }
        } else {
            $errorMsg = "We are unable to process your request now. Please try again later.";
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
<html lang="en">
    <head>
        <title>Change Password</title>
       
        <meta http-equiv="refresh" content="5;url=account.php" />
    </head>
    <body>

        <main class="container">

            <?php
            if ($success) {
                echo "<h3>You have successfully changed your password!</h3>";
                echo "<h4>You will be redirected back to My Account page in 3 seconds...</h4>";
            } else {
                echo "<h3>Oops!</h3>";
                echo "<h4>The following input errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo "<a class=\"btn btn-danger\" href=\"account.php\">Return to My Account</a>";
            }
            ?>

        </main>
        <?php
        include "footer.inc.php";
        ?>
    </body>
</html>