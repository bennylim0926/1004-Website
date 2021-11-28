<?php
session_start();
$config = parse_ini_file('../../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
$stmt = $conn->prepare("SELECT * FROM accounts WHERE uname=?");
$stmt->bind_param("i", $_SESSION["uname"]);
$stmt->execute();
$result = $stmt->get_result();
//include('../Session/SessionCheckUser.php');
if(isset($_POST['placeorder'])){
    $_SESSION['total_item'] = $_POST["total_item"];
    $_SESSION['total_price'] = $_POST["total_price"];
    header("location: checkout_confirmation.php");
    exit;
}
if (isset($_GET['placeorder'])) {
    if (isset($_SESSION['uname'])) {
        //query using the user id
        $stmt = $conn->prepare("SELECT acc_id FROM accounts WHERE uname=?");
        $stmt->bind_param("s", $_SESSION["uname"]);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        //get the result
        $stmt = $conn->prepare("SELECT * FROM accounts_has_products WHERE accounts_acc_id=?");
        $stmt->bind_param("i", $row['acc_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = array();
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        //use foreach loop to query delete from main database
        foreach ($items as $item) {
            //check original stock
            $stmt = $conn->prepare("SELECT * FROM products WHERE id=? ");
            $stmt->bind_param("i", $item['products_id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row1 = $result->fetch_assoc();

            //minus the user quanity
            $new_quantity = $row1['quantity'] - $item["quantity"];
            $stmt = $conn->prepare("UPDATE products SET quantity=? "
                    . "WHERE id=?");
            $stmt->bind_param("ii", $new_quantity, $item["products_id"]);
            $stmt->execute();
        }

        $stmt = $conn->prepare("DELETE FROM accounts_has_products");
        $stmt->execute();
    } else {
        if (isset($_COOKIE['cart'])) {
            setcookie('cart', "", time() - 3600);
        }
    }
}
?>

<html>
    <?php
    include '../head.inc.php';
    ?>
    <body style="background-color:whitesmoke">
        <?php
        include '../nav.inc.php';
        ?> 
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="collapse navbar-collapse">
                <a class="navbar-brand">CHECK OUT</a>
            </div>
        </nav>
        <main class="container">
            <h2 class="mt-5">
                Member's Details
            </h2>
            <form>
                <div class="input-group">
                    <label class="mb-0 mt-2 mr-2" for="email">Email Address: </label>
                    <input type="email" class="form-control mr-2" id="email" placeholder="JohnDoe123@email.com" value=<?= $row['email'] ?> >
                    <label class="mb-0 mt-2 mr-2" for="name">Name: </label>
                    <input type="name" class="form-control mr-2" id="name" placeholder="John Doe" value=<?= $row['lname'] ?> >
                </div>
            </form>
            <form id="checkout" action="checkout_confirmation.php" method="post">
                <div class="input-group">
                    <!--<div class="form-group col-sm-5 p-0">-->
                        <label class="mb-0 mt-2 mr-2" for="address">Delivery Address</label>
                        <input type="text" class="form-control mr-2" id="email" placeholder="Enter delivery address"required>
                    <!--</div>-->
                    <!--<div class="form-group col-sm-3 p-0">-->
                        <label class="mb-0 mt-2 mr-2" for="phone">Contact Number</label>
                        <input type="tel" class="form-control mr-2" id="phone" placeholder="Enter contact number" pattern="[0-9]{8}" required>
                    <!--</div>-->
                </div>
                <h2 class="mt-5">Payment Type</h2>
                <div>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-outline-secondary active">
                            <input class='mx-auto' type="radio" name="options" id="option1" autocomplete="off" checked> Credit/Debit Cart
                        </label>
                        <label class="btn btn-outline-secondary">
                            <input type="radio" name="options" id="option2" autocomplete="off"> PayPal
                        </label>
                        <label class="btn btn-outline-secondary">
                            <input type="radio" name="options" id="option3" autocomplete="off"> PayNow
                        </label>
                    </div>
                </div>
                <p>Total Items: <?= $_SESSION["total_item"] ?></p>
                <p>Total Price: &dollar;<?= $_SESSION["total_price"] ?></p>
                <div>
                    <input type="submit" class="btn-lg btn-outline-primary mr-3 my-3" value="Place Order" name="checkout" id='checkout'>
                    <input type="hidden" name="total_item" id="total_item" value="<?= $_SESSION["total_item"] ?>">
                    <a class="btn btn-lg btn-outline-danger mr-3 my-3" href="cart.php">Back to cart</a>
                </div>
            </form>
        </main>
    </body>
</html>