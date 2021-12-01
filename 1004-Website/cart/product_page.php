<?php
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
        //if user login 
        if (isset($_SESSION['uname'])) {
            $stmt = $conn->prepare("SELECT acc_id FROM accounts WHERE uname=?");
            $stmt->bind_param("s", $_SESSION["uname"]);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            //$row['acc_id'] is the user id
            //select from accountsHasProducts table see whether user id and item got result
            $stmt = $conn->prepare("SELECT * FROM accounts_has_products WHERE products_id=? AND accounts_acc_id=?");
            $stmt->bind_param("ii", $product_id, $row['acc_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row2 = $result->fetch_assoc();
//            echo $row2['quantity'];
            if ($result->num_rows == 1) {
                //update exsting value
                $new_value = $row2["quantity"] + $quantity;
                echo $new_value;
                $stmt = $conn->prepare('UPDATE accounts_has_products SET quantity=? '
                        . 'WHERE products_id=?');
                $stmt->bind_param("ii", $new_value, $product_id);
                $stmt->execute();
            } else {
                //add into new column
                $stmt = $conn->prepare('INSERT INTO accounts_has_products(accounts_acc_id, products_id, quantity)'
                        . 'VALUE(?,?,?)');
                $stmt->bind_param("iii", $row['acc_id'], $product_id, $quantity);
                $stmt->execute();
            }
        } else {
            if (isset($_COOKIE['cart'])) {
                $cookie_data = stripslashes($_COOKIE['cart']);
                $cart_data = json_decode($cookie_data, true);
                if (array_key_exists($product_id, $cart_data)) {
                    //Product exists in cart so just update the quanity
                    $cart_data[$product_id] += $quantity;
                    $item_data = json_encode($cart_data);
                    setcookie('cart', $item_data, time() + (86400 * 30));
                } else {
                    // Product is not in cart so add it
                    $cart_data[$product_id] = $quantity;
                    $item_data = json_encode($cart_data);
                    setcookie('cart', $item_data, time() + (86400 * 30));
                }
            } else {
                $_COOKIE['cart'] = array($product_id => $quantity);
                $item_data = json_encode($_COOKIE['cart']);
                setcookie('cart', $item_data, time() + (86400 * 30));
            }
        }
    } else {
        //its out of stock
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
    $array = array();
    while ($row = $result->fetch_assoc()) {
        $array[] = $row;
    }
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
<html>
    <?php
    include '../head.inc.php';
    ?>
    <body style="background-color: whitesmoke">
        <?php
        include '../nav.inc.php';
        ?>
        <main class="container">
            <div class="row product-container my-5">
                <!--            <article class="col-sm-1">
                                    </article>-->
                <article class="col-sm-4">
                    <br><br>
                    <figure style="text-align: center">
                        <img class="image-thumbnail" src="../images/products/<?= $product['img'] ?>" width="400" height="300"alt="<?= $product['name'] ?>">
                        <h1 class="product-name"><?= $product['name'] ?></h1>
                    </figure>
                </article>
                <article class="col-sm-2">
                </article>
                <article class="col-sm-4">
                    <br><br>
                    <h3>Quantity</h3>
                    <h5 class="price">
                        &dollar;<?= $product['price'] ?>
                        <?php if ($product['rrp'] > 0): ?>
                            <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
                        <?php endif; ?>
                    </h5>
                    <br>
                    <div class="description">
                        <?= $product['desc'] ?>
                    </div>
                    <br>
                    <h3>Quantity</h3>
                    <h5><?= $product['quantity'] ?> pieces available</h5>
                    <form id="add-to-cart" action="product_page.php?id=<?= $product['id'] ?>" method="post">
                        <?php if ($product['quantity'] > 0): ?>
                            <input type="number" name="quantity" id="quantity" value="1" min="0" max="<?= $product['quantity'] ?>" placeholder="Quantity" required>
                            <input type="hidden" name="product_id" id="product_id" value="<?= $product['id'] ?>">
                            <input class="btn btn-outline-secondary" type="submit" value="Add To Cart">
                        <?php else: ?>
                            <p>Out of stock</p>
                        <?php endif; ?>

                    </form>
                </article>
                <article class="col-sm-2">
                </article>
            </div>
        </main>
        <?php
        include '../footer.inc.php';
        ?>
    </body>
</html>
