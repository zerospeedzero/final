<?php
    require "assets/database.php";
    $connect = connect();
    $products = db_query($connect, "select * from products order by id desc limit 4;");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Home Page ~ Jake Morin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php require "assets/header.php"
        ?>
        <main>
            <h1>ReadyTech has everything to satisfy your technology needs!</h1>
            <p>Let us supply you with the perfect gear to get your gaming collection started. We have a deep catalogue of handhelds, home consoles and peripherals. Check some of our featured products below!</p>
            <h2>Featured Products</h2>
            <ul>
                <?php
                    foreach ($products as $product) {
                        echo "<figure>";
                        echo "<img src=\"./thumbnail/" . $product["thumbnail"] . "\">";
                        echo "<figcaption>" . $product["name"] . " - " . $product["price"] . "<a href=\"./cartadd.php?id=" . $product["id"] . "&quantity=1\">Add to Cart</a>" . "</figcaption>";
                        echo "</figure>";
                    }
                ?>
            </ul>
        </main>
        <?php
            require "assets/footer.php";
        ?>
    </body>
</html>