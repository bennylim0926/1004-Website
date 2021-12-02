
<nav class="navbar navbar-expand-sm navbar-custom navbar-dark sticky-top" role="navigation" >
    <di class="container-fluid">
        <button class="navbar-toggler ml-auto " type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>    
        <div class="collapse navbar-collapse justify-content-between" id="navbarTogglerDemo01">
            <a class="navbar-brand logo" href="/1004-Website/index.php"><img src="/1004-Website/images/site_logo.png" alt="Logo" title="Logo" width="86" height="103"/></a>
            <!--<a class="navbar-brand" href="index.php"><img src="/1004-Website/images/general/itstuff.jpg" alt="Logo" title="Logo" width="120" height="90"/></a>-->
            <ul class="nav navbar-nav navbar-left">   
                <li class="nav-item">
                    <a class="nav-link" href="/1004-Website/index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/1004-Website/catalogue.php">CATALOGUE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/1004-Website/locate-us.php">LOCATE US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/1004-Website/about-us.php">ABOUT US</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right ml-auto">
                <li>
                    <?php
                    if (isset($_SESSION["uname"])) {
                        $profile_pic = "";
                        include("Connection/connection.php");
                        $stmt = $conn->prepare("SELECT photo FROM accounts WHERE uname=?");
                        $stmt->bind_param("s", $_SESSION["uname"]);
                        include("Connection/handle_sql_execute_failure.php");
                        $conn->close();
                        $profile_pic = $result->fetch_assoc()["photo"];
                        if ($profile_pic == null)
                            $profile_pic = "/1004-Website/images/default_avatar.png";
                        echo "<li class='nav-item'> <a class='nav-link'> <img alt='Avatar' class='avatar' src='$profile_pic' id='avatarimg'> Welcome back, " . $_SESSION["uname"] . "</a></li>";
                        unset($profile_pic);

                        echo "<li class='nav-item'> <a class='nav-link' href='/1004-Website/cart/cart.php'><span class='material-icons'>shopping_cart</span>Shopping Cart</a></li>";

                        echo "<li class='nav-item'> <a class='nav-link' href='/1004-Website/edit_account.php'><span class='material-icons'>account_circle</span>Edit Account</a></li>";

                        if (($_SESSION['admin']) == true) {
                            echo "<li class='nav-item'> <a class='nav-link' href='/1004-Website/adminpage.php'><span class='material-icons'>account_circle</span>User management</a></li>";
                        }

                        echo "<li class='nav-item'> <a class='nav-link' href='/1004-Website/logout.php'><span class='material-icons'>logout</span>Logout</a></li>";
                    } else {
                        ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/1004-Website/cart/cart.php"><span class="material-icons">shopping_cart</span>SHOPPING CART</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/1004-Website/register.php"><span class="material-icons">account_circle</span>REGISTER</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav_right" href="/1004-Website/login.php"><span class="material-icons">login</span>LOGIN</a> 
                    </li>

                    <?php
                }
                ?>

                </li>
            </ul>
        </div>
        </div>
</nav>     