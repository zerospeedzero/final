<?php
    require "assets/database.php";
    session_start();
    $format = numfmt_create("en_CA", NumberFormatter::CURRENCY);
    $connect = connect();
    $subtotal = 0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Cart Page ~ Jake Morin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php require "assets/header.php"
        ?>
        <main>
            <table>
                <caption>
                    Your Cart
                </caption>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($_SESSION["cart"] as $id => $quantity) {
                            $product = db_query($connect, "select * from products where id=$id;")[0];
                            echo "<tr>";
                            echo "<td>" . $product["name"] . "</td>";
                            echo "<td>" . numfmt_format($format, $product["price"] * $quantity) . "</td>";
                            echo "<td>" .
                                    '<form method="GET" action="cartadd.php">' .
                                        '<input type="hidden" name="id" value="' . $id . '">' .
                                        '<input type="number" name="quantity" value="' . $quantity . '">' .
                                    '</form>' .
                                "<td>";
                            echo '<td><a href="cartadd.php?id=' . $id . '&quantity=0">Remove</a></td>';
                            echo "</tr>";
                            $subtotal = $subtotal + $product["price"] * $quantity;
                        } 
                    ?>
                </tbody>
            </table>
            <label for="subtotal">Subtotal</label>
            <!-- had to look up what the span tag does, basically just marking up the specified text -->
            <span id="subtotal"><?php echo numfmt_format($format, $subtotal); ?></span>
            <label for="tax">GST</label>
            <span id="tax"><?php
                $gsttax = $subtotal * 0.05;
                print numfmt_format($format, $gsttax);
            ?></span>
            <label for="total">Total</label>
            <span id="total"><?php
                $total = $subtotal + $gsttax;
                print numfmt_format($format, $subtotal + $gsttax);
            ?></span>
        </main>
        <?php
            require "assets/footer.php";
        ?>
    </body>
</html>
