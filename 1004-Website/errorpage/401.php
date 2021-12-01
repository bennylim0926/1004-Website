<?php 
  $currentPage = '401'; 
?>

<html>
  <?php
    include "/1004-Website/head.inc.php";
    ?>
  <body>
    <div id="all">
    <?php
        include "/1004-Website/nav.inc.php";
    ?>
    <div id="content">
      <div class="container">
        <div id="error-page" class="col-md-8 mx-auto text-center">
          <div class="box">
            <h3>Sorry, you do not have access to this page</h3>
            <h4 class="text-muted">Error 401 - Unauthorized Access</h4>
            <p class="buttons"><a href="index.php" class="btn btn-template-outlined"><i class="fa fa-home"></i> Go to Homepage</a></p>
          </div>
        </div>
      </div>
    </div>
     <?php
        include "../footer.inc.php";
    ?>
    </div>
  </body>
</html>