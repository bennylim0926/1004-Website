<!DOCTYPE html>
<html>
    <?php
    include 'head.inc.php';
    ?>
    <body>
        <?php
        include 'nav.inc.php';
        $email = $errorMsg = "";
        $lname = "";
        $pwd = $pwd_comfirm = "";
        $pwd_hashed = "";
        $success = true;
        if (empty($_POST["email"])) {
            $errorMsg .= "Email is required.<br>";
        } else {
            $email = sanitize_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMsg .= "Invalid email format.";
            }
        }
        if (empty($_POST["lname"])) {
            $errorMsg .= "Last name is required.<br>";
        } else {
            $lname = sanitize_input($_POST["lname"]);
        }
        if (empty($_POST["pwd"])) {
            $errorMsg .= "Password is required.<br>";
        } else {
            $pwd = $_POST["pwd"];
        }
        if (empty($_POST["pwd_confirm"])) {
            $errorMsg .= "Please comfirm your password.<br>";
        } else {
            $pwd_comfirm = $_POST["pwd_confirm"];
            $pwd_hashed = password_hash($pwd_comfirm,PASSWORD_DEFAULT);
        }
        if ($pwd != $pwd_comfirm) {
            $errorMsg .= "Please re-confrim your password<br>";
        }
        echo "<div class='space'>";
        if ($success) {
            echo "<h1>Registrarion is succeful!</h1>";
            echo "<h2>Thanks for signing up, " . $lname . "</h2>";
            echo "<a href='index.php' class='btn btn-success'>Login</a>";
            saveMemberToDB();
        } else {
            echo "<h1>The following errors were detected: </h1>";
            echo  "<h3>" . $errorMsg . "</p>";
            echo "<a href='register.php' class='btn btn-danger'>Try again</a>";
        }
        echo "</div>";

        //Helper function that checks input for malicious or unwanted content.
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        function saveMemberToDB(){
            global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;
            
            // Create database connection
            $config = parse_ini_file('../../private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
            
            // Check connection
            if($conn->connect_error){
                $errorMsg = "Connection Failed: ". $conn->connect_error;
                $success = false;
            }
            else{
                // Prepare statement
                $stmt = $conn->prepare("INSERT INTO world_of_pets_members (fname, lname, email, password) VALUES (?, ?, ?, ?)");
                
                // Bind & execute the query statement
                $stmt->bind_param("ssss", $fname, $lname, $email, $pwd_hashed);
                if(!$stmt->execute()){
                    $errorMsg = "Execute Failed: (' . $stmt->errno')". $stmt->error;
                    $success =false;
                }
                $stmt->close();
            }
            $conn->close();
        }
        ?>
        <?php
        include 'footer.inc.php';
        ?>   
    </body>
</html>
