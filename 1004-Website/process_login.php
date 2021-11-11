<<!doctype html>
<html>
    <?php
    include 'head.inc.php';
    ?>
    <body>
        <?php
        include 'nav.inc.php';
        $email = $errorMsg = $pwd = "";
        $success =true;
        if(empty($_POST['email'])){
            $errorMsg .= "Email is required.<br>";
        }else{
            $email = sanitize_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMsg .= "Invalid email format.";
            }
        }
        if (empty($_POST["pwd"])) {
            $errorMsg .= "Password is required.<br>";
        } else {
            $pwd = $_POST["pwd"];
        }
        authenticateUser();
        echo "<div class='space'>";
        //authenticateUser();
        if ($success) {
            echo "<h1>Login succefully!</h1>";
            echo "<h2>Welcome, " . $lname . "!</h2>";
            echo "<a href='index.php' class='btn btn-success'>Back to Menu</a>";
        } else {
            echo "<h1>The following errors were detected: </h1>";
            echo  "<h3>" . $errorMsg . "</p>";
            echo "<a href='login.php' class='btn btn-danger'>Try again</a>";
        }
        echo "</div>";
        
        // Helper function to authenticate the login
        function authenticateUser() {
            global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;

            // Create database connection
            $config = parse_ini_file('../../private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'],
                    $config['dbname']);

            // Check connection
            if ($conn->connect_error) {
                $errorMsg .= "Connection Failed: " . $conn->connect_error;
                $success = false;
            } else {
                // Prepare statement
                $stmt = $conn->prepare("SELECT * FROM world_of_pets_members WHERE email=?");

                // Bind & execute the query statement:
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    // Note that email field is unique, so should
                    // only have one row in the result set.
                    $row = $result->fetch_assoc();
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $pwd_hashed = $row['password'];

                    // Check password if matches
                    if (!password_verify($_POST["pwd"], $pwd_hashed)) {
                        $errorMsg .= "Email not found or password doesn't match";
                        $success = false;
                    }
                } else {
                    $errorMsg .= "Email not found or password doesn't match";
                    $success = false;
                }
                $stmt->close();
            }
            $conn->close();
        }
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        ?>       
        <?php
        include 'footer.inc.php';
        ?> 
    </body>
</html>
