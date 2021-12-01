<!<!doctype html>
<html>
<?php
 include 'head.inc.php';
?>
    <body>
        <?php
        include 'nav.inc.php';
        ?>
        <main class="container">
            
            <h2 align="center">
                For new members, 
                please go to the <a href="register.php">Sign up page</a>
            </h2>
            <div id="registration-form">
            <div class='fieldset'>
                <legend>Member Login</legend>
            <form action="process/process_login.php" method="post">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input class="form-control" type="email" id="email" required name="email"
                           placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input class="form-control" type="password" id="pwd" required name="pwd"
                           placeholder="Enter password">
                </div>
                <div class='form-group'>
                    <button class='btn btn-primary' type="submit">Login</button>
                </div>
                
            </form>
    </div>
</div>
        </main>
        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>