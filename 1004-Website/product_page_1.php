<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.

STATIC PAGE FOR REFERENCE
-->
<html>
    <?php
    include 'head.inc.php';
    ?>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        
        <a class="nav-link" href="index.php"><span class="material-icons">home</span></a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="product_static.php">BACK TO CATALOG</a>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                         <a class="nav-link" href="register.php"><span class="material-icons">account_circle</span>REGISTER</a> 
                     </li>
                    <li class="nav-item">
                         <a class="nav-link" href="login.php"><span class="material-icons">login</span>LOGIN</a> 
                     </li>
        </ul>
    </div>
</nav>       
        <main class="container">
            <section id="monitors">
                <br>
                <div class="row">
                    <article class="col-sm-5">
                        <figure>                            
                            <img class="img-thumbnail" src="images/monitors/monitor1.jpeg" alt="Monitor"
                                 title="View larger image..." />                                                                          
                            <figcaption>Monitor 1</figcaption>
                        </figure>
                    </article>
                    <article class="col-sm-2">
                    </article>
                    <article class="col-sm-5">
                        <br><br><br><br><br>
                        <p>Very nice monitor</p>
                        <h3>$120</h3>
                        <form action="/action_page.php">
                        <label for="quantity">Quantity:</label>
  <select name="quantity" id="quantity">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
  </select>
                        <br><br>
                        <input type="submit" value="Add To Cart">
                        </form>
                    </article>
                </div>
        </main>
        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>


