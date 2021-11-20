<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="index.php"><img src="images/dogeLogo.jfif" alt="Logo" title="Logo" width="86" height="103"/></a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=index.php#dogs">Dogs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php#cats">Cats</a>
            </li>                   
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                   <?php
                if (isset($_SESSION["uname"])) {
                    echo "<li class='nav-item'> <a class='nav-link'><span class='material-icons'>account_box</span> Welcome back, " . $_SESSION["uname"] . "</a></li>";                
                    echo "<li class='nav-item'> <a class='nav-link' href='account.php'><span class='material-icons'>account_circle</span>Edit Account</a></li>";
                    echo "<li class='nav-item'> <a class='nav-link' href='logout.php'><span class='material-icons'>logout</span>Logout</a></li>";
                    
                } else { ?>
                    <li class="nav-item">
                         <a class="nav-link" href="register.php"><span class="material-icons">account_circle</span>Register</a> 
                     </li>
                    <li class="nav-item">
                         <a class="nav-link" href="login.php"><span class="material-icons">login</span>Login</a> 
                     </li>
                     
            <?php
                }
            ?>
                
            </li>
        </ul>
    </div>
</nav>     