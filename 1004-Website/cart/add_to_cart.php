<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

//for remove button
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    //unset($_SESSION['cart'][$_GET["remove"]]);
    $data = $_SESSION['cart'];    // Get the value
    unset($data[$_GET["remove"]]);               // Remove an item (hardcoded the second here)
    $_SESSION['cart'] = $data;
    header("location: add_to_cart.php");
    exit;
}
if (isset($_GET['removeAll']) && is_numeric($_GET['removeAll']) && isset($_SESSION['cart'])) {
    // Remove the product from the shopping cart
    //unset($_SESSION['cart'][$_GET["remove"]]);
//    $data = $_SESSION['cart'];    // Get the value
    unset($_SESSION['cart']);
    header("location: add_to_cart.php");
    exit; // Remove an item (hardcoded the second here)
}


// for update button
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int) $v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    header("location: add_to_cart.php");
    exit;
}

if (isset($_POST['placeorder']) && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    unset($_SESSION['cart']);
    header("location: place_order.php");
    exit;
}

$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
//print_r($products_in_cart);
$subtotal = 0.00;
$totalItem = 0;
$products = array();
////// If there are products in cart
if ($products_in_cart) {
    $key = array_keys($products_in_cart);
    $i = 1;
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $array_to_i_marks = implode("", array_fill(0, count($products_in_cart), 'i'));
    $config = parse_ini_file('../../../private/db-config.ini');
    $newconn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
    $newstmt = $newconn->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
//    echo $array_to_question_marks;
    $newstmt->bind_param($array_to_i_marks, ...$key);
//    $stmt->bind_param($types, $array_to_i_marks, $array_to_question_marks)
    $newstmt->execute();
    $result = $newstmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
//    echo $result->num_rows;
    foreach ($products as $product) {
        $subtotal += (float) $product["price"] * (int) $products_in_cart[$product['id']];
        $totalItem += (int) $products_in_cart[$product['id']];
    }
}
?>
<head>
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
    <script  src="../js/main.js"></script>
</head>
<html>
    <?php
    include '../head.inc.php';
    ?>
    <body>
        <?php
        include '../nav.inc.php';
        ?>   

        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="collapse navbar-collapse">
                <a class="navbar-brand">Shopping Cart</a>
            </div>
        </nav>
        <main class="container">
            <!--<form action="add_to_cart.php" method="post">-->
            <div class="table-responsive-sm" id='cart_table'>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Product(s)</td>
                            <td class="text-right">Unit Price</td>
                            <td class="text-right">Quantity</td>
                            <td class="text-right">Total Price</td>
                            <td class="text-right">Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)): ?>
                            <tr class='cartStatus'>
                                <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <tr class='wholeCart'>
                                    <td class="cart-img">
                                        <a href="test_product_template.php?id=<?= $product['id'] ?>">
                                            <img src="../images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
                                        </a>
                                        <a href="test_product_template.php?id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
                                    </td>
                                    <td class="price text-right align-middle">&dollar;<?= $product['price'] ?></td>
                                    <td class="quantity text-right align-middle">
                                        <form action="add_to_cart.php" method="post">
                                            <input type="number" name="quantity-<?= $product['id'] ?>" value="<?= $products_in_cart[$product['id']] ?>" min="1" max="<?= $product['quantity'] ?>" placeholder="<?= $products_in_cart[$product['id']] ?>" >
                                        </form>
                                    </td>
                                    <td class="price text-right align-middle">&dollar;<?= $product['price'] * $products_in_cart[$product['id']] ?></td>
                                    <td class="text-right align-middle"><a href="add_to_cart.php?remove=<?= $product['id'] ?>" class="remove">Remove</a></td> 

                                </tr>

                            <?php endforeach; ?>
                        <?php endif; ?>
                        <tr>
                            <td class="align-middle">
                                <form action="add_to_cart.php" method="post">
                                    <input type="submit" value="Update" name="update">
                                </form>
                                <a href="add_to_cart.php?removeAll=1" class=" align-middle">Remove All</a>
                            </td>
                            <td>
                                <!--<form id="cart_page" action="add_to_cart.php?removeAll=1" method="GET">-->  
                                <form action="add_to_cart.php" method="post">
                                    <input type="hidden" name="remove" id='remove' type="submit" value="1">
                                </form>
                                <!--</form>-->
                            </td> 
                            <td class="text-right"></td>
                            <td class="text-right align-middle"> Total Item(s): <?= $totalItem ?></td>
                            <td class="text-right align-middle">&dollar;<?= $subtotal ?></td>
                            <td class="text-right">
                            <td class="align-middle">  
                                <form action="add_to_cart.php" method="post">
                                    <input type="submit" value="Check Out" name="placeorder">
                                </form>
                            </td>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <!--</form>-->
            <div>
                <h3>YOU MAY ALSO LIKE</h3>
                <figure style="display:inline;margin:auto">
                    <img src="../images/dogeLogo.jfif" alt="Poodle"
                         title="View larger image..." />                                                                          
                    <img src="../images/dogeLogo.jfif" alt="Poodle"
                         title="View larger image..." />                                                                            
                    <img src="../images/dogeLogo.jfif" alt="Poodle"
                         title="View larger image..." />   
                    <img src="../images/dogeLogo.jfif" alt="Poodle"
                         title="View larger image..." />  
                    <img src="../images/dogeLogo.jfif" alt="Poodle"
                         title="View larger image..." />       
                </figure>
            </div>
        </main>
        <?php
        include '../footer.inc.php';
        ?>
    </body>
</html>