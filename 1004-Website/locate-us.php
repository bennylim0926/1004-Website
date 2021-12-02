<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <?php
    include 'head.inc.php';
    ?>
    <body>
        <?php
        include 'nav.inc.php';
        ?> 
        <main>
            <div class="container-fluid">
                <div class="row text-center">
                    <div class="col-12">
                        <section id="maps">
                            <h1 class="sectiontitle"><strong>Store location</strong></h1>
                            <h2>We can be located at the following area:</h2>

                        </section>
                    </div>
                    <div class="col-12 mapouter map-responsive">
                        <!--<div class="gmap_canvas">-->
                            <iframe title="embedded map frame" class="map-control" width="600" height="500" id="gmap_canvas" alt="embedded map" src="https://maps.google.com/maps?q=SIT&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net">fmovies</a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net">google maps create map</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style>
                        <!--</div>-->
                    </div>
                </div>

            </div>
        </main>
        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>