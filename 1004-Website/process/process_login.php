<!doctype html>
<html>
    <?php
    include '../head.inc.php';
    ?>
    <body>
        <?php
        include '../nav.inc.php';
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
        echo "<div class='space text-center'>";
        //authenticateUser();
        if ($success) {
             $_SESSION["fname"] = $fname;
             $_SESSION["lname"] = $lname;
             $_SESSION["email"] = $email;
             $_SESSION["uname"] = $uname;
             $_SESSION["admin"] = $admin;
             $_SESSION["userID"] = $userID;
           
            echo "<h4 class='display-4'>Login Successful!</h4>";
            echo "<h3><b>Welcome back, " . $uname ."</b></h3>";
            //echo "<div class='alert alert-info'> <b><strong>Welcome back, '$uname'</strong></b> </div>";
       
            //echo "<p><a href='/1004-Website/index.php' class='btn btn-success'>Back to Home</a></p>";
            echo '<meta http-equiv="refresh" content="2;url=/1004-Website/index.php" />Redirecting to Home page</a>';
               
        } else {
            echo "<p><h1>The following errors were detected: </h1>";
            echo  "<h3>" . $errorMsg . "</p>";
            echo "<a href='/1004-Website/login.php' class='btn btn-danger'>Try again</a>";
        }
        echo "</div>";
        
        // Helper function to authenticate the login
        function authenticateUser() {
            global $fname, $lname, $email, $admin, $pwd_hashed, $uname, $errorMsg, $success,$userID;

            // Create database connection
            $config = parse_ini_file('../../../private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');

            // Check connection
            if ($conn->connect_error) {
                $errorMsg .= "Connection Failed: " . $conn->connect_error;
                $success = false;
            } else {
                // Prepare statement
                $stmt = $conn->prepare("SELECT * FROM accounts WHERE email=?");

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
                    $uname = $row['uname'];
                    $userID = $row['acc_id'];
                    if($row['admin']==1)
                        $admin = true;
                    else
                        $admin = false;
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
        include '../footer.inc.php';
        ?> 
    </body>
</html>
