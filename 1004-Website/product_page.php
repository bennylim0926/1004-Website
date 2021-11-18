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
        <?php
        include 'nav.inc.php';
        ?>
        <header class="jumbotron text-center">
            <h1 class="display-4">Product Page</h1>
            <h2>All our products</h2>
        </header>       
        <main class="container">
            <section id="dogs">
                <h2 class="sectiontitle">Monitors</h2>
                <div class="row">
                    <article class="col-sm">
                        <figure>                            
                            <img class="img-thumbnail" src="images/monitors/monitor1.jpeg" alt="Monitor"
                                 title="View larger image..." />                                                                          
                            <figcaption>Monitor 1</figcaption>
                        </figure>
                        <p>
                            Monitor 1 $12
                        </p>
                    </article>
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/monitors/monitor2.jpeg" alt="Monitor"
                                 title="View larger image..."/>                                                                               

                            <figcaption>Monitor 2</figcaption>
                        </figure>
                        <p>
                            Monitor 2 $35
                        </p>
                    </article>
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/monitors/monitor3.jpg" alt="Monitor"
                                 title="View larger image..."/>                                                                               

                            <figcaption>Monitor 3</figcaption>
                        </figure>
                        <p>
                            Monitor 3 $45
                        </p>
                    </article>
                </div>
                <div class="row">
                    <article class="col-sm">
                        <figure>                            
                            <img class="img-thumbnail" src="images/monitors/monitor4.jpg" alt="Monitor"
                                 title="View larger image..." />                                                                          
                            <figcaption>Monitor 4</figcaption>
                        </figure>
                        <p>
                            Monitor 4 $12
                        </p>
                    </article>
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/monitors/monitor5.jpg" alt="Monitor"
                                 title="View larger image..."/>                                                                               

                            <figcaption>Monitor 5</figcaption>
                        </figure>
                        <p>
                            Monitor 5 $35
                        </p>
                    </article>
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/monitors/monitor6.jpg" alt="Monitor"
                                 title="View larger image..."/>                                                                               

                            <figcaption>Monitor 6</figcaption>
                        </figure>
                        <p>
                            Monitor 6 $45
                        </p>
                    </article>
                </div>
            </section>
            <section id="cats">
                <h2 class="sectiontitle">Keyboards</h2>
                <div class="row">
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/keyboards/keyboard1.jpg" alt="Keyboard"
                                 title="View larger image..." />                                              
                            <figcaption>Keyboard 1</figcaption>
                        </figure>
                        <p>
                            Keyboard 1 $2
                        </p>
                    </article>
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/keyboards/keyboard2.jpg" alt="Keyboard"
                                 title="View larger image..." />                                              
                            <figcaption>Keyboard 2</figcaption>
                        </figure>
                        <p>
                            Keyboard 2 $5
                        </p>
                    </article>
                </div>
                <div class="row">
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/keyboards/keyboard3.jpg" alt="Keyboard"
                                 title="View larger image..." />                                              
                            <figcaption>Keyboard 3</figcaption>
                        </figure>
                        <p>
                            Keyboard 3 $10
                        </p>
                    </article>
                    <article class="col-sm">
                        <figure>
                            <img class="img-thumbnail" src="images/keyboards/keyboard4.jpg" alt="Keyboard"
                                 title="View larger image..." />                                              
                            <figcaption>Keyboard 4</figcaption>
                        </figure>
                        <p>
                            Keyboard 4 $15
                        </p>
                    </article>
                </div>
            </section>
        </main>
        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>


