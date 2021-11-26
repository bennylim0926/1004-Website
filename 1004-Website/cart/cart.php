<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
session_start();
$config = parse_ini_file('../../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
//for remove button
if (isset($_GET['remove']) && is_numeric($_GET['remove'])) {
    if (isset($_SESSION['uname'])) {
        $stmt = $conn->prepare("DELETE FROM accounts_has_products WHERE products_id=?");
        $stmt->bind_param("i", $_GET['remove']);
        $stmt->execute();
        //need to reload after load from database
    } else {
        if (isset($_COOKIE['cart'])) {
            $cookie_data = stripslashes($_COOKIE['cart']);
            $cartdata = json_decode($cookie_data, true);
            unset($cartdata[$_GET["remove"]]);
            $item_data = json_encode($cartdata);
            setcookie('cart', $item_data, time() + (86400 * 30));
            //if user login
            //connect to db and remove all the record
            header("location: cart.php");
            exit;
        }
    }
}
if (isset($_POST['removeAll']) && is_numeric($_POST['removeAll'])) {
    if (isset($_SESSION['uname'])) {
        $stmt = $conn->prepare("DELETE FROM accounts_has_products");
        $stmt->execute();
    } else {
        if (isset($_COOKIE['cart'])) {
            setcookie('cart', "", time() - 3600);
        }
    }
}

// for update button
if (isset($_POST['update'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int) $v;
            $cookie_data = stripslashes($_COOKIE['cart']);
            $cartdata = json_decode($cookie_data, true);

            if (is_numeric($id) && $quantity > 0) {
                if ($_SESSION['uname']) {
                    $stmt = $conn->prepare("SELECT acc_id FROM accounts WHERE uname=?");
                    $stmt->bind_param("s", $_SESSION["uname"]);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $stmt2 = $conn->prepare("UPDATE accounts_has_products SET quantity=? "
                            . "WHERE products_id=? AND accounts_acc_id=?");
                    $stmt2->bind_param("iii", $quantity, $id ,$row['acc_id']);
                    $stmt2->execute();
                } else {
                    if (isset($cartdata[$id])) {
                        $cartdata[$id] = $quantity;
                        $item_data = json_encode($cartdata);
                        setcookie('cart', $item_data, time() + (86400 * 30));
                    }
                }
            }
        }
    }
}

if (isset($_GET['placeorder'])) {
    if (isset($_SESSION['uname'])) {
        $stmt = $conn->prepare("DELETE FROM accounts_has_products");
        $stmt->execute();
    } else {
        if (isset($_COOKIE['cart'])) {
            setcookie('cart', "", time() - 3600);
        }
    }
}

if ($_SESSION["uname"]) {
    $stmt = $conn->prepare("SELECT acc_id FROM accounts WHERE uname=?");
    $stmt->bind_param("s", $_SESSION["uname"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt = $conn->prepare("SELECT * FROM accounts_has_products WHERE accounts_acc_id=?");
    $stmt->bind_param("i", $row['acc_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $cart_data = array();
    while ($row = $result->fetch_assoc()) {
        $cart_data[$row['products_id']] = $row['quantity'];
    }
} else {
    $product_in_cookies = isset($_COOKIE['cart']) ? $_COOKIE['cart'] : array();
    $cookie_data = stripslashes($product_in_cookies);
    $cart_data = json_decode($cookie_data, true);
    print_r($cart_data);
}
$subtotal = 0.00;
$totalItem = 0;
$products = array();
if ($cart_data) {
    $key = array_keys($cart_data);
    $i = 1;
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($cart_data), '?'));
    $array_to_i_marks = implode("", array_fill(0, count($cart_data), 'i'));
    $config = parse_ini_file('../../../private/db-config.ini');
    $newconn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
    $newstmt = $newconn->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    $newstmt->bind_param($array_to_i_marks, ...$key);
    $newstmt->execute();
    $result = $newstmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    foreach ($products as $product) {
        $subtotal += (float) $product["price"] * (int) $cart_data[$product['id']];
        $totalItem += (int) $cart_data[$product['id']];
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
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="collapse navbar-collapse">
                <a class="navbar-brand">Shopping Cart</a>
            </div>
        </nav>
        <main class="container">
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
                                <tr>
                                    <td class="cart-img">
                                        <a href="product_page.php?id=<?= $product['id'] ?>">
                                            <img src="../images/<?= $product['img'] ?>" alt="<?= $product['name'] ?>">
                                        </a>
                                        <a href="product_page.php?id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
                                    </td>
                                    <td class="price text-right align-middle">&dollar;<?= $product['price'] ?></td>
                                    <td class="quantity text-right align-middle">
                                        <div >
                                            <button class='decrement'>-</button>
                                            <input class='quantity' id="<?= $product['id'] ?>" type="number" name="quantity-<?= $product['id'] ?>" value="<?= $cart_data[$product['id']] ?>" min="1" max="<?= $product['quantity'] ?>" placeholder="<?= $cart_data[$product['id']] ?>"readonly >
                                            <button class='increment'>+</button>
                                        </div>
                                    </td>
                                    <td class="price text-right align-middle toReload">&dollar;<?= $product['price'] * $cart_data[$product['id']] ?></td>
                                    <td class="text-right align-middle"><a href="cart.php?remove=<?= $product['id'] ?>" class="remove">Remove</a></td> 
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <tr class>
                            <td class="align-middle">
                                <button><a id="remove_all" href="cart.php" class="remove">Remove ALL</a></button> 
                            </td>
                            <td>

                            </td> 
                            <td class="text-right"></td>
                            <td class="text-right align-middle toReload_totalItem"> Total Item(s): <?= $totalItem ?></td>
                            <td class="text-right align-middle toReload_all_price">&dollar;<?= $subtotal ?></td>
                            <td class="text-right">
                            <td class="align-middle">  
                                <form id="checkout" action="cart.php" method="post">
                                    <input type="hidden" name="total_item" id="total_item" value="<?= $totalItem ?>">
                                    <input type="submit" value="Check Out" name="placeorder" id='placeorder'>
                                </form>
                            </td>
                            <td>                                    
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