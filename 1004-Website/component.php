<?php

function component($name, $id){
   $element = "   
        <article class=\"col-sm\">
                        <figure>
                            <a href=\"productid=$id.php\">
                            <img class=\"img-thumbnail\" src=\"images/monitors/monitor1.jpeg\" alt=\"Monitor\"
                                 title=\"Click to view details...\" />
                            </a>
                            <figcaption>$name</figcaption>
                        </figure>
                    </article>
    ";
   
 echo $element;         
            
}

