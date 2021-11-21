<!doctype html>
<html>
    <?php
    include 'head.inc.php';
    ?>
    <body>
        <?php
        include 'nav.inc.php';
        ?>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="collapse navbar-collapse">
                <a class="navbar-brand">Check Out</a>
            </div>
        </nav>
        <main class="container">
            <div class='deliveryContainer'style="background-color: lightgray">
                <h4 class="deliveryInfo">Delivery Address</h4>
                <div>
                    <span class="deliveryInfo"><b>Jon Doe</b> </span>
                    <span class="deliveryInfo"><b>(+65) 11112222</b></span>
                    <span class="deliveryInfo">BLOCK 07, THE ONE, #07-777, SG 110110</span>
                    <button class="deliveryInfo">Change</button>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <td class="text-left">Product(s) Ordered </td>
                        <td class="text-right">Unit Price</td>
                        <td class="text-right">Quantity</td>
                        <td class="text-right">Total Price</td>
                        <!--<td class="text-right">Action</td>-->
                    </tr>
                </thead>
            </table>

        </main>
        <?php
        include 'footer.inc.php';
        ?>
    </body>
</html>

