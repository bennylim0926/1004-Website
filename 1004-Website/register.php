
<?php
    include "head.inc.php";
?>
<body>
    <?php
        include "nav.inc.php";
    ?>
    
    <main class="container">
        <h1>Member Registration</h1>
        
        <p>
            For existing members, please go to the <a href="login.php#">Sign In Page</a>
        </p>
        
        <form action="process_register.php" method="post">
            <div class="form-group">
                <label for="fname">
                    First Name(optional):
                </label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter First Name" maxlength="45">
            </div>
            
            <div class="form-group">
                <label for="lname">
                    Last Name:
                </label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter Last Name" maxlength="45" required>
            </div>
            <div class="form-group">
                <label for="uname">
                    Username:
                </label>
                <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter your preferred Username" maxlength="45" required>
            </div>
            
            <div class="form-group">  
                <label for="email">
                    Email:
                </label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                

            </div>
            
            <div class="form-group">
                <label for="pwd">
                    Password:
                </label>
                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter Password" required>
               
            </div>
            
            <div class="form-group">
                <label for="pwd_confirm">
                    Confirm Password:
                </label>
                <input type="password" class="form-control" id="pwd_confirm" name="pwd_confirm" placeholder="Confirm Password" required>
                             
            </div>
            
            <div class="form-check">
                <label>
                    <input type="checkbox" name="agree" required>                               
                    Agree to terms and  conditions.
                </label>
            </div>
            
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </main>
    
    <?php
        include "footer.inc.php";
    ?>
</body>
