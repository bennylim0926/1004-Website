<?php
ob_start();
session_start();
// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
// Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int) $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];
    $config = parse_ini_file('../../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
    if ($conn->connect_error) {
//        $errorMsg .= "Connection Failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the SQL statement, we basically are checking if the product exists in our databaser
        // Fetch the product from the database and return the result as an Array 
        $stmt = $conn->prepare('SELECT * FROM products WHERE id = ?');
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $productList = array();
        //$productList = $result->fetch_assoc();
        while ($row = $result->fetch_assoc()) {
            $productList[] = $row;
        }
    }
    //echo print_r($productList);
    // Check if the product exists (array is not empty)
    if ($productList && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                //Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
                //echo "<p>Existing item in the cart</p>";
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
                //echo "<p>No this product in the cart</p>";
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
            //echo "Check session array" . print_r($_SESSION['cart']['product_id']);
            //echo "<p>No product all at in the cart</p>";
        }
    }
    // spmething
    //header('Location: add_to_cart.php');
    //exit;
}
//for remove button
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
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
    // Prevent form resubmission...
    header('Location: add_to_cart.php');
    exit;
}
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$subtotal = 0.00;
$products = array();
//// If there are products in cart
if ($products_in_cart) {
    //echo "<p>Second part of the code</p>";
    $key = array_keys($products_in_cart);
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $array_to_i_marks = implode('', array_fill(0, count($products_in_cart), 'i'));
    $array_to_key = implode(',', array_fill(0, count($products_in_cart), 'i'));
    //echo $array_to_i_marks;
    $stmt = $conn->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
//    // We only need the array keys, not the values, the keys are the id's of the products
    //echo print_r(array_keys($products_in_cart));
//    $key = array_keys($products_in_cart);
    //echo $key[0];
    //echo $_SESSION['cart'][0];
    $stmt->bind_param($array_to_i_marks, ...$key);
    $stmt->execute();
    $result = $stmt->get_result();
    //echo "Blank here";
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    //$products = $result->fetch_assoc();
    //echo print_r($products[0]);
    // Calculate the subtotal
    foreach ($products as $product) {
        //echo $product["price"];
        $subtotal += (float) $product["price"] * (int) $products_in_cart[$product['id']];
    }
}
ob_end_flush();
?>
<div>
    <h1>Shopping Cart</h1>
    <form action="add_to_cart.php" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td class="img">
                                <a href="test_product_template.php?id=<?= $product['id'] ?>">
                                    <img src="../images/<?= $product['img'] ?>" width="50" height="50" alt="<?= $product['name'] ?>">
                                </a>
                            </td>
                            <td>
                                <a href="test_product_template.php?id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
                                <br>
                                <a href="add_to_cart.php?remove=<?= $product['id'] ?>" class="remove">Remove</a>
                            </td>
                            <td class="price">&dollar;<?= $product['price'] ?></td>
                            <td class="quantity">
                                <input type="number" name="quantity-<?= $product['id'] ?>" value="<?= $products_in_cart[$product['id']] ?>" min="1" max="<?= $product['quantity'] ?>" placeholder="<?= $products_in_cart[$product['id']] ?>" >
                            </td>
                            <td class="price">&dollar;<?= $product['price'] * $products_in_cart[$product['id']] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="subtotal">
            <span class="text">Subtotal</span>
            <span class="price">&dollar;<?= $subtotal ?></span>
        </div>
        <div class="buttons">
            <input type="submit" value="Update" name="update">
            <input type="submit" value="Place Order" name="placeorder">
        </div>
    </form>
</div>