<!DOCTYPE html>
<html>
    <?php
    include '../head.inc.php';
    ?>
    <body>
        <?php
        include '../nav.inc.php';
        
        $email = $errorMsg = "";
        $lname = "";
        $pwd = $pwd_comfirm = "";
        $pwd_hashed = "";
        $success = true;
        
        
    if (!checkpassword($_POST["pwd"], $_POST["pwd_confirm"])) 
    {
        $errorMsg .= "Passwords are not the same. <br>";
        $success = false;
    }
    
        foreach($_POST as $key=>$value) 
    {
        if ($key != "fname") // check for all keys except for fname
        {
            if (empty($value)) //if value of the key is empty
            {
                $errorMsg .= $fields[$key] . " is required.<br>"; // add this field key to errorMsg
                $success = false; // return success = false             
            }
        }
        
        $value = sanitize_input($value);
        if ($key == "email") {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errorMsg .= "Invalid Email Format. <br>";
                $success = false;
            } else {
                $email = $value; 
            }
        }
        elseif ($key == "lname") 
        {
            $lname = $value; 
        }
        elseif($key == "fname")
        {
            $fname = $value; 
        }
         elseif($key == "uname")
        {
            $uname = $value; 
        }
        elseif($key == "pwd")
        {
            $pwd_hashed = password_hash($value, PASSWORD_DEFAULT);
        }
        }
        
        if (!isset($_POST["agree"])) {
        $errorMsg .= "Terms and Conditions not Checked. <br>";
        $success = false;
         }
        
        echo "<div class='space text-center'>";
        if ($success) 
        {
            saveMemberToDB();// call savemembertodb() 
            if($success)//if success is false after savemembertodb() is called. print errormsg
            {
            echo "<h1>Registration was successful!</h1>";
            echo "<h2>Thanks for signing up, " . $lname . "</h2>";
            echo "<a href='../login.php' class='btn btn-success'>Login</a>"; 
            }
            else 
            {   if(strpos($errorMsg, $email) !== false)
                { // check if errormsg from sql states email that user input is already being used.
                    echo "<h1>The following errors were detected: </h1>";
                    echo  "<h3> Email Address is Already Registered, Please use another email address </p>";
                    echo "<a href='../register.php' class='btn btn-danger'>Try again</a>"; 
                }
               else if(strpos($errorMsg, $uname) !== false)
                {
                    echo "<h1>The following errors were detected: </h1>";
                    echo  "<h3>The username," . $uname . " is taken, please user another username</p>"; 
                    echo "<a href='../register.php' class='btn btn-danger'>Try again</a>";
                }
                else{
                    echo "<h1>The following errors were detected: </h1>";
                    echo  "<h3>" . $errorMsg . "</p>";
                    echo "<a href='../register.php' class='btn btn-danger'>Try again</a>";
                }
            }
        }  
        else
        {
            echo "<h1>The following errors were detected: </h1>";
            echo  "<h3>" . $errorMsg . "</p>";
            echo "<a href='register.php' class='btn btn-danger'>Try again</a>";
        }     
            echo "</div>";
        
        function checkpassword($pwd1, $pwd2) 
         {
        if ($pwd1 === $pwd2) {
            return true;
        } 
        else 
        {
            return false;
        }
        }    
        //Helper function that checks input for malicious or unwanted content.
        function sanitize_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        function saveMemberToDB()
        {
            global $fname, $lname, $email, $uname, $pwd_hashed, $errorMsg, $success;
            
            // Create database connection
            $config = parse_ini_file('../../../private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
            
            
            // Check connection
            if($conn->connect_error)
            {
                $errorMsg = "Connection Failed: ". $conn->connect_error;
                $success = false;
            }
            else{
                // Prepare statement
                $stmt = $conn->prepare("INSERT INTO accounts (fname, lname, uname, email, password) VALUES (?, ?, ?, ?,?)");           
                // Bind & execute the query statement
                $stmt->bind_param("sssss", $fname, $lname, $uname, $email, $pwd_hashed);
                if(!$stmt->execute())
                {
                    $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
                    $success = false;
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
