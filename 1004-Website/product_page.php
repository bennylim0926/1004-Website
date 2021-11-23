<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
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
                <a class="nav-link" href="#monitors">MONITOR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#keyboards">KEYBOARD</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#mouse">MOUSE</a>
            </li>
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
        <header class="jumbotron text-center">
            <h1 class="display-4">Product Page</h1>
            <h2>All our products</h2>
        </header>       
        <main class="container">
            <section id="monitors">
                <h2 class="producttitle">Monitor</h2>
                <div class="row">
                    <article class="col-sm">
                        <figure>                            
                            <img class="img-thumbnail" src="images/monitors/monitor1.jpeg" alt="Monitor"
                                 title="View larger image..." />                                                                          
                            <figcaption>Monitor 1</figcaption>
                        </figure>
                    </article>
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/monitors/monitor2.jpeg" alt="Monitor"
                                 title="View larger image..."/>                                                                               

                            <figcaption>Monitor 2</figcaption>
                        </figure>
                    </article>
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/monitors/monitor3.jpg" alt="Monitor"
                                 title="View larger image..."/>                                                                               

                            <figcaption>Monitor 3</figcaption>
                        </figure>
                    </article>
                </div>
                
            </section>
            <section id="keyboards">
                <h2 class="producttitle">Keyboard</h2>
                <div class="row">
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/keyboards/keyboard1.jpg" alt="Keyboard"
                                 title="View larger image..." />                                              
                            <figcaption>Keyboard 1</figcaption>
                        </figure>
                    </article>
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/keyboards/keyboard2.jpg" alt="Keyboard"
                                 title="View larger image..." />                                              
                            <figcaption>Keyboard 2</figcaption>
                        </figure>
                    </article>
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/keyboards/keyboard3.jpg" alt="Keyboard"
                                 title="View larger image..." />                                              
                            <figcaption>Keyboard 3</figcaption>
                        </figure>
                    </article>
                </div>
            </section>
            <section id="mouse">
                <h2 class="producttitle">Computer Mouse</h2>
                <div class="row">
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/mouse/mouse1.jpg" alt="Mouse"
                                 title="View larger image..." />                                              
                            <figcaption>Mouse 1</figcaption>
                        </figure>
                    </article>
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/mouse/mouse2.jpg" alt="Mouse"
                                 title="View larger image..." />                                              
                            <figcaption>Mouse 2</figcaption>
                        </figure>
                    </article>
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/mouse/mouse3.jpeg" alt="Mouse"
                                 title="View larger image..." />                                              
                            <figcaption>Mouse 3</figcaption>
                        </figure>
                    </article>
                </div>
            </section>
        </main>
        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>


