<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and opentest github
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
            <h1 class="display-4">Welcome to World of Pets</h1>
            <h2>Home of Singapore's Pet Lovers</h2>
        </header>       
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

