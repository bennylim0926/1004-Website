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
<div>
    <?php
    include '../head.inc.php';
    ?>
    <body>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        
        <a class="nav-link" href="/1004-Website/index.php"><span class="material-icons">home</span></a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/1004-Website/catalogue.php">BACK TO CATALOG</a>
        </ul>
        <ul class="navbar-nav ml-auto">
                    <li>
                        <?php
                        if (isset($_SESSION["uname"])) {
                            echo "<li class='nav-item'> <a class='nav-link'><span class='material-icons'>account_box</span> Welcome back, " . $_SESSION["uname"] . "</a></li>";
                            echo "<li class='nav-item'> <a class='nav-link' href='/1004-Website/account.php'><span class='material-icons'>account_circle</span>Edit Account</a></li>";
                            if (($_SESSION['admin']) == true) {
                                echo "<li class='nav-item'> <a class='nav-link' href='/1004-Website/adminpage.php'><span class='material-icons'>account_circle</span>User management</a></li>";
                            }
                            
                            echo "<li class='nav-item'> <a class='nav-link' href='/1004-Website/logout.php'><span class='material-icons'>logout</span>Logout</a></li>";
                        } else {
                            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/1004-Website/register.php"><span class="material-icons">account_circle</span>REGISTER</a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/1004-Website/login.php"><span class="material-icons">login</span>LOGIN</a> 
                        </li>

                        <?php
                    }
                    ?>

                    </li>
                </ul>
    </div>
</nav>
        <div class="row">
            <article class="col-sm-1">
                    </article>
            <article class="col-sm-4">
                <br><br>
                <figure>
                    <img class="image-thumbnail" src="../images/products/<?= $product['img'] ?>" width="400" height="300"alt="<?= $product['name'] ?>">
                    <h1 class="product-name"><?= $product['name'] ?></h1>
                </figure>
            </article>
            <article class="col-sm-1">
                    </article>
            <article class="col-sm-5">
                <br><br><br>
            <h3 class="price">
                &dollar;<?= $product['price'] ?>
                <?php if ($product['rrp'] > 0): ?>
                    <span class="rrp">&dollar;<?= $product['rrp'] ?></span>
                <?php endif; ?>
            </h3>
                
            <div class="description">
                <?= $product['desc'] ?>
            </div>
                <br>
                <h4>Quantity</h4>
                <form id="add-to-cart" action="product_page.php?id=<?= $product['id'] ?>" method="post">
                <?php if ($product['quantity'] > 0): ?>
                    <input type="number" name="quantity" id="quantity" value="1" min="0" max="<?= $product['quantity'] ?>" placeholder="Quantity" required>
                    <input type="hidden" name="product_id" id="product_id" value="<?= $product['id'] ?>">
                    <input type="submit" value="Add To Cart">
                <?php else: ?>
                    <p>Out of stock</p>
                <?php endif; ?>

            </form>
            </article>
        </div>
        <?php
        include '../footer.inc.php';
        ?>
    </body>
</div>
