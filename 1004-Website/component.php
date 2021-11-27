<?php

function component($name, $id){
    
   $element = "   
        <article class=\"col-sm\">
                        <figure>
                            <a href=\"productid.php?echo id=$id\">
                            <img class=\"img-thumbnail\" src=\"images/monitors/monitor1.jpeg\" alt=\"$name\"
                                 title=\"Click to view details...\" />
                            </a>
                            <figcaption>$name</figcaption>
                        </figure>
        </article>
    ";
   
 echo $element;         
            
}

