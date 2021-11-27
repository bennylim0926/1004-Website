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
            <h1 class="display-4">Welcome to ICT1004 Group 5 Website!</h1>
            <h2>Home of your favourite IT peripherals</h2>
        </header>
        <?php
            include "carousel.php"
        ?>
<!--            <section id="maps">
                <h2 class="sectiontitle">Store location</h2>
                <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=SIT&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net">fmovies</a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net">google maps create map</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>
            </section>
        </main>-->       
        <main class="container">
            <section id="dogs">
                <h2 class="sectiontitle">All About Dogs!</h2>
                <div class="row">
                    <article class="col-sm">
                        <h3>Poodles</h3>
                        <figure>
                            <img class="img-thumbnail" src="images/poodle_small.jpg" alt="Poodle"
                                 title="View larger image..." />                                                                          
                            <figcaption>Standard Poodle</figcaption>
                        </figure>
                        <p>Poodles are a group of formal dog breeds, the Standard
                            Poodle, Miniature Poodle and Toy Poodle...
                        </p>
                    </article>
                    <article class="col-sm">
                        <h3>Chihuahua</h3>
                        <figure>

                            <img class="img-thumbnail" src="images/chihuahua_small.jpg" alt="Poodle"
                                 title="View larger image..."/>                                                                               

                            <figcaption>Standard Chihuahua</figcaption>
                        </figure>
                        <p>
                            The Chihuahua is the smallest breed of dog, and is named
                            after the Mexican state of Chihuahua...
                        </p>
                    </article>
                </div>
            </section>
            <section id="cats">
                <h2 class="sectiontitle">All About Cats</h2>
                <div class="row">
                    <article class="col-sm">
                        <h3>Tabby</h3>
                        <figure>
                            <img class="img-thumbnail" src="images/tabby_small.jpg" alt="Poodle"
                                 title="View larger image..." />                                              
                            <figcaption>Standard Tabby</figcaption>
                        </figure>
                        <p>
                            A tabby is any domestic cat with an 'M' on its forehead,
                            stripes by its eye and across its cheeks...
                        </p>
                    </article>
                    <article class="col-sm">
                        <h3>Calico</h3>
                        <figure>
                            <img class="img-thumbnail" src="images/calico_small.jpg" alt="Poodle"
                                 title="View larger image..." />                                              
                            <figcaption>Standard Calico</figcaption>
                        </figure>
                        <p>
                            A calico cat is a domestic cat with a coat that is typically
                            25% to 75% white and has large orange and black patches...
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

