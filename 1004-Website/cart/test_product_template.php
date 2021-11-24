<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Check to make sure the id parameter is specified in the URL
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
// Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int) $_POST['product_id'];

    $quantity = (int) $_POST['quantity'];
    $config = parse_ini_file('../../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
    if ($conn->connect_error) {
        $success = false;
    } else {
// Prepare the SQL statement, we basically are checking if the product exists in our databaser
// Fetch the product from the database and return the result as an Array 
        $stmt = $conn->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $productList = array();
        while ($row = $result->fetch_assoc()) {
            $productList[] = $row;
        }
    }
    if ($productList && $quantity > 0) {
// Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
//Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
// Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
}

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
<head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
              crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
              rel="stylesheet">
    <link rel="stylesheet" href="../css/checkout.css">
    <script 
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"
        >
    </script>

    <!-- Bootstrap JS -->
    <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
            integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm"
            crossorigin="anonymous">
    </script>
    <script defer src="../js/main.js"></script>    

</head>

<div>
    <?php
    include '../head.inc.php';
    ?>
    <img src="../images/<?= $product['img'] ?>" width="500" height="500" alt="<?= $product['name'] ?>">
    <div>
        <h1 class="name"><?= $product['name'] ?><?= $product['id'] ?></h1>
        <span class="price">
            &dollar;<?= $product['price'] ?>
            <?php if ($product['rrp'] > 0): ?>
                <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
            <?php endif; ?>
        </span>
        <form id="add-to-cart" action="test_product_template.php?id=<?= $product['id'] ?>" method="post">
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?= $product['quantity'] ?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" id="product_id" value="<?= $product['id'] ?>">
            <input id="myWish" type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?= $product['desc'] ?>
        </div>

    </div>
</div>
