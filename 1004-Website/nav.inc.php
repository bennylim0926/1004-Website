<nav class="navbar navbar-expand-sm navbar-dark bg-dark" >
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01" >
        <ul class="navbar-nav" >
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <a class="navbar-brand" href="/1004-Website/index.php"><img src="/1004-Website/images/dogeLogo.jfif" alt="Logo" title="Logo" width="86" height="103"/></a>
                <a class="navbar-brand" href="index.php"><img src="/1004-Website/images/general/itstuff.jpg" alt="Logo" title="Logo" width="120" height="90"/></a>
                <ul class="navbar-nav"> 
                <li class="nav-item">
                <a class="nav-link" href="about.php">ABOUT</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product_page.php">OUR PRODUCTS</a>
            </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="/1004-Website/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/1004-Website/index.php#dogs">Dogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/1004-Website/index.php#cats">Cats</a>
                    </li>    
                    <li class="nav-item">
                        <a class="nav-link" href="/1004-Website/cart/test_home.php">Products</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link" href="/1004-Website/cart/add_to_cart.php">Products</a>
                    </li>  
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li>
                        <?php
                        if (isset($_SESSION["uname"])) {
                            echo "<li class='nav-item'> <a class='nav-link'><span class='material-icons'>account_box</span> Welcome back, " . $_SESSION["uname"] . "</a></li>";
                            echo "<li class='nav-item'> <a class='nav-link' href='account.php'><span class='material-icons'>account_circle</span>Edit Account</a></li>";
                            if (($_SESSION['admin']) == true) {
                                echo "<li class='nav-item'> <a class='nav-link' href='adminpage.php'><span class='material-icons'>account_circle</span>User management</a></li>";
                            }
                            echo "<li class='nav-item'> <a class='nav-link' href='uploadimages.php'><span class='material-icons'>account_circle</span>Upload Images</a></li>";
                            echo "<li class='nav-item'> <a class='nav-link' href='logout.php'><span class='material-icons'>logout</span>Logout</a></li>";
                        } else {
                            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/1004-Website/register.php"><span class="material-icons">account_circle</span>REGISTER</a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/1004-Website/login.php"><span class="material-icons">login</span>LOGIN</a> 
                        </li>

                        <?php
                    }
                    ?>

                    </li>
                </ul>
        </ul>
    </div>
</nav>     