<?php
// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    $config = parse_ini_file('../../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');

    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int) $_POST['product_id'];
    $quantity = (int) $_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
    $stmt = $conn->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->bind_param("i", $_POST['product_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    // Fetch the product from the database and return the result as an Array
    $product = $result->fetch_assoc();
    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }

    // Prevent form resubmission...
    header('location: add_to_cart.php');
    exit;
}

$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;
//echo "Is there any product in cart ". empty($_SESSION['cart']);
// If there are products in cart
if ($products_in_cart) {
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $conn->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->bind_param("i", array_keys($products_in_cart));
    $stmt->execute();
    $result = $stmt->get_result();
    echo "The total result is" . $result->num_rows;
    // Fetch the products from the database and return the result as an Array
    $products = $result->fetch_all();
    // Calculate the subtotal
    foreach ($products as $product) {
        $subtotal += (float) $product['price'] * (int) $products_in_cart[$product['id']];
    }
}
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
                                <a href="index.php?page=product&id=<?= $product['id'] ?>">
                                    <img src="imgs/<?= $product['img'] ?>" width="50" height="50" alt="<?= $product['name'] ?>">
                                </a>
                            </td>
                            <td>
                                <a href="index.php?page=product&id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
                                <br>
                                <a href="index.php?page=cart&remove=<?= $product['id'] ?>" class="remove">Remove</a>
                            </td>
                            <td class="price">&dollar;<?= $product['price'] ?></td>
                            <td class="quantity">
                                <input type="number" name="quantity-<?= $product['id'] ?>" value="<?= $products_in_cart[$product['id']] ?>" min="1" max="<?= $product['quantity'] ?>" placeholder="Quantity" required>
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


