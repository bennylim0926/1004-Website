<?php
session_start();
$config = parse_ini_file('../../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], 'ITshop');
if ($conn->connect_error) {
    $errorMsg .= "Connection Failed: " . $conn->connect_error;
    $success = false;
} else {
    $stmt = $conn->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
    $stmt->execute();
    $result = $stmt->get_result();
    $array = array();
    while ($row = $result->fetch_assoc()) {
        $array[] = $row;
    }
}
?> 

<div>
    <h2>Gadgets</h2>
    <p>Essential gadgets for everyday use</p>

    <div >
        <h2>Recently Added Products</h2>
        <div >
            <?php foreach ($array as $product): ?>    
                <a href="test_product_template.php?id=<?= $product['id'] ?>" class="product">
                    <img src="../images/<?= $product['img'] ?>" width="200" height="200" alt="<?= $product['name'] ?>">
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
</div>
