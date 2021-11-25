<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity=
        "sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
        crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css" />
        <!--jQuery-->
        <script defer
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
        </script>
        <title></title>
    </head>
    <body>
        <main>
            <?php
                include "nav.inc.php";
                require_once 'component.php';
            ?>
            <div class ="main-category">
                <div class="col-md-5 col-sm-6 my-3 my-md-0">
                    <div class="category-heading">
                        <p>CATEGORIES</p>
                    </div>
                    <div class ="items">
                        <?php
                                include 'categories.php';                                
                        ?>
                    </div>
                </div>
                
                <div class="product">
                    <div class ="featured-products">
                        <p>FEATURED PRODUCTS</p>
                    </div>
                    <div class ="product-info">    
                        <div class="camera">
                           <?php
                                include "product.php"
                          ?>      

                    </div>
                    
                    
                    
                </div>
                
                
                
                
            </div>

        </main>
<?php
include "footer.inc.php";
?>
</body>
</html>