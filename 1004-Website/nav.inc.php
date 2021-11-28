
<nav class="navbar navbar-expand-sm navbar-custom " >
    <button class="navbar-toggler ml-auto navbar-light" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarTogglerDemo01">
                <a class="navbar-brand logo" href="/1004-Website/index.php"><img src="/1004-Website/images/site_logo.png" alt="Logo" title="Logo" width="86" height="103"/></a>
                <!--<a class="navbar-brand" href="index.php"><img src="/1004-Website/images/general/itstuff.jpg" alt="Logo" title="Logo" width="120" height="90"/></a>-->
                <ul class="nav navbar-nav navbar-left">   
                    <li class="nav-item">
                        <a class="nav-link" href="/1004-Website/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/1004-Website/about-us.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/1004-Website/locate-us.php">Locate Us</a>
                    </li>    
                    <li class="nav-item">
                        <a class="nav-link" href="/1004-Website/cart/test_home.php">Products</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link" href="/1004-Website/cart/cart.php">Products</a>
                    </li>  
                </ul>
                <ul class="nav navbar-nav navbar-right ml-auto">
                    <li>
                        <?php
                       
                        if (isset($_SESSION["uname"])) {
                            echo "<li class='nav-item'> <a class='nav-link'><span class='material-icons'>account_box</span> Welcome back, " . $_SESSION["uname"] . "</a></li>";
                            
                           $profile_pic = "";
                            $config = parse_ini_file('../../private/db-config.ini');
                            $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');

                            if ($conn->connect_error) 
                            {
                               $errorMsg = "Connection failed: " . $conn->connect_error;
                               $success = false;
                               $conn->close();
                            }
                            if(mysqli_connect_errno())
                           {
                           echo 'Database Connection Error';
                           }
                           $stmt = $conn->prepare("SELECT photo FROM accounts WHERE uname=?");
                           $stmt->bind_param("s", $_SESSION["uname"]);
                           require("Connection/handle_sql_execute_failure.php");
                            $conn->close();
                            $profile_pic = $result->fetch_assoc()["photo"];
                            //echo "<li class='nav-item'><img src='$profile_pic' alt='Profile Picture'></li></div>";
                            echo "<li class='nav-item'><img class='rounded-circle article-img' src='$profile_pic' id='img'></li>";
                            unset($profile_pic);
                           
                           
                            echo "<li class='nav-item'> <a class='nav-link' href='/1004-Website/edit_account.php'><span class='material-icons'>account_circle</span>Edit Account</a></li>";
                            if (($_SESSION['admin']) == true) {
                                echo "<li class='nav-item'> <a class='nav-link' href='/1004-Website/adminpage.php'><span class='material-icons'>account_circle</span>User management</a></li>";
                            }
                            
                            echo "<li class='nav-item'> <a class='nav-link' href='/1004-Website/logout.php'><span class='material-icons'>logout</span>Logout</a></li>";
                        } else {
                            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><span class="material-icons">shopping_cart</span>Shopping Cart</a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/1004-Website/register.php"><span class="material-icons">account_circle</span>Register</a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/1004-Website/login.php"><span class="material-icons">login</span>LOGIN</a> 
                        </li>

                        <?php
                    }
                    ?>

                    </li>
                </ul>
    </div>
</nav>     