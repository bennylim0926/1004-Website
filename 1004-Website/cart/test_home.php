<?php
session_start();
$config = parse_ini_file('../../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
if ($conn->connect_error) {
    $errorMsg .= "Connection Failed: " . $conn->connect_error;
    $success = false;
} else {
    $stmt = $conn->prepare('SELECT * FROM products');
    $stmt->execute();
    $result = $stmt->get_result();
    $array = array();
    while ($row = $result->fetch_assoc()) {
        $array[] = $row;
    }
}
?> 

<html>
    <?php
    include '../head.inc.php';
    ?>
    <body>
        <?php
        include '../nav.inc.php';
        ?>
        <header class="jumbotron text-center">
            <h4>Click on each image to view their details and add to cart!</h4>
        </header>       
    <main class="container">
        <section id="monitors">
        <h2 class="producttitle">Monitors</h2>
        <div class="row1">
                <figure>
            <?php foreach ($array as $product): ?>
            <a href="product_page.php?id=<?= $product['id'] ?>" class="product">
                <img class="image-thumbnail" src="../images/products/<?= $product['img'] ?>" width="450" height="360" alt="<?= $product['name'] ?>">
                    <figcaption>^<span class="name"><?= $product['name'] ?></span>>
                    <span class="price">
                        &dollar;<?= $product['price'] ?>
                        <?php if ($product['rrp'] > 0): ?>
                            <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
                        <?php endif; ?>
                    </span>^</figcaption>        
                </a>
                    <br>
            <?php endforeach; ?>
                </figure>
        </div>
        </section>
    <div>
        <h2 class="producttitle">Keyboards</h2>
        <div >
            <?php foreach ($array as $product): ?>    
            <a href="product_page.php?id=<?= $product['id'] ?>" class="product">
                    <img src="../images/products/<?= $product['img'] ?>" width="200" height="200" alt="<?= $product['name'] ?>">
                    <span class="name"><?= $product['name'] ?></span>>
                    <span class="price">
                        &dollar;<?= $product['price'] ?>
                        <?php if ($product['rrp'] > 0): ?>
                            <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
                        <?php endif; ?>
                    </span>        
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div>
        <h2 class="producttitle">Computer Mouse</h2>
        <div >
            <?php foreach ($array as $product): ?>    
            <a href="product_page.php?id=<?= $product['id'] ?>" class="product">
                    <img src="../images/products/<?= $product['img'] ?>" width="200" height="200" alt="<?= $product['name'] ?>">
                    <span class="name"><?= $product['name'] ?></span>>
                    <span class="price">
                        &dollar;<?= $product['price'] ?>
                        <?php if ($product['rrp'] > 0): ?>
                            <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
                        <?php endif; ?>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div>
        <h2 class="producttitle">Webcams</h2>
        <div >
            <?php foreach ($array as $product): ?>    
            <a href="product_page.php?id=<?= $product['id'] ?>" class="product">
                    <img src="../images/products/<?= $product['img'] ?>" width="200" height="200" alt="<?= $product['name'] ?>">
                    <span class="name"><?= $product['name'] ?></span>>
                    <span class="price">
                        &dollar;<?= $product['price'] ?>
                        <?php if ($product['rrp'] > 0): ?>
                            <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
                        <?php endif; ?>
                    </span>        
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div>
        <h2 class="producttitle">Speakers</h2>
        <div >
            <?php foreach ($array as $product): ?>    
            <a href="product_page.php?id=<?= $product['id'] ?>" class="product">
                    <img src="../images/products/<?= $product['img'] ?>" width="200" height="200" alt="<?= $product['name'] ?>">
                    <span class="name"><?= $product['name'] ?></span>>
                    <span class="price">
                        &dollar;<?= $product['price'] ?>
                        <?php if ($product['rrp'] > 0): ?>
                            <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
                        <?php endif; ?>
                    </span>        
                </a>
            <?php endforeach; ?>
        </div>
    </div>
        </main>
    <?php
        include '../footer.inc.php';
        ?>
    </body>
</html>
