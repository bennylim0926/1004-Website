<?php //
//session_start();
//if(!isset($_SESSION['uname'])){ //if login session is not set, redirect user to 401 page.
//    header("Location: ../401.php");
//    exit();
//}
?>
<!doctype html>
<html>
    <?php
    include 'head.inc.php';
    ?>
    <body>
        <?php
        include 'nav.inc.php';
        ?>        
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="collapse navbar-collapse">
                <a class="navbar-brand">Shopping Cart</a>
            </div>
        </nav>
        <main class="container">
            <table class="table">
                <thead>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Product(s)
                                </label>
                            </div>
                        </td>
                        <td class="text-right">Unit Price</td>
                        <td class="text-right">Quantity</td>
                        <td class="text-right">Total Price</td>
                        <td class="text-right">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Monitor QWERTY
                                </label>
                            </div>
                        </td>
                        <td class="text-right">$30.00</td>
                        <td class="text-right">2</td>
                        <td class="text-right">$60.00</td>
                        <td class="text-right">
                            <button class='btn btn-danger'>
                                Remove
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Monitor QWERTY
                                </label>
                            </div>
                        </td>
                        <td class="text-right">$30.00</td>
                        <td class="text-right">2</td>
                        <td class="text-right">$60.00</td>
                        <td class="text-right">
                            <button class='btn btn-danger'>
                                Remove
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Monitor QWERTY
                                </label>
                            </div>
                        </td>
                        <td class="text-right">$30.00</td>
                        <td class="text-right">2</td>
                        <td class="text-right">$60.00</td>
                        <td class="text-right">
                            <button class='btn btn-danger'>
                                Remove
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right"> </td>
                        <td class="text-right"></td>
                        <td class="text-right">Total(6 items): $360.00</td>
                        <td class="text-right">
                            <button class='btn btn-primary'>
                                Check Out
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>  
            <div>
                <h3>YOU MAY ALSO LIKE</h3>
                <figure style="display:inline;margin:auto">
                    <img src="../images/dogeLogo.jfif" alt="Poodle"
                         title="View larger image..." />                                                                          
                    <img src="images/dogeLogo.jfif" alt="Poodle"
                         title="View larger image..." />                                                                            
                    <img src="images/dogeLogo.jfif" alt="Poodle"
                         title="View larger image..." />   
                    <img src="images/dogeLogo.jfif" alt="Poodle"
                         title="View larger image..." />  
                    <img src="images/dogeLogo.jfif" alt="Poodle"
                         title="View larger image..." />       
                </figure>
            </div>
        </main>
        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>
