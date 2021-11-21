<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $config = parse_ini_file('../../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
    $stmt = $conn->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    //echo $result->num_rows ;
    $array = array();
    while ($row = $result->fetch_assoc()) {
        $array[] = $row;
    }
    //$product[] = $result->fetch_assoc();
//    echo $result->num_rows;
    $product = $array[0];

    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else { 
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
?>

<div>
    <img src="../images/<?= $product['img'] ?>" width="500" height="500" alt="<?= $product['name'] ?>">
    <div>
        <h1 class="name"><?= $product['name'] ?></h1>
        <span class="price">
            &dollar;<?= $product['price'] ?>
            <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
            <?php endif; ?>
        </span>
        <form action="add_to_cart.php" method="post">
            <input type="number" name="quantity" value="1" min="1" max="<?= $product['quantity'] ?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?= $product['desc'] ?>
        </div>
    </div>
</div>
