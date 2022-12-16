<?php
    require "assets/database.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $sort = (isset($_GET["sort"])) ? $_GET["sort"] : "id";
        if (isset($_GET["filter"])) {
            $filter = $_GET["filter"];
            $filterby = "where category like '$filter%'";
        } else {
            $filterby = "where true";
        }
        $connect = connect();
        $products = db_query($connect, "SELECT * FROM `products` $filterby ORDER BY `$sort`;");
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Products Listing Page ~ Jake Morin</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <?php require "assets/header.php"; 
            ?>
            <main>
                <p>Sort By:</p>
                <a href="products.php?sort=product">Name</a>
                <a href="products.php?sort=price">Price</a>
                <a href="products.php?filter=Handheld">Handhelds</a>
                <a href="products.php?filter=Console">Consoles</a>
                <a href="products.php?filter=Peripheral">Peripherals</a>
            <ul>
            <?php
                foreach ($products as $product) {
                    $id = $product["id"];
                    $name = $product["product"];
                    $price = $product["price"];
                    echo "<figure>";
                    echo "<img src=\" ./thumbnail/" . $product["thumbnail"] . "\">";
                    echo "<figcaption>" . $product["product"] . " - $" . $product["price"] . "</figcaption>";
                    echo "</figure>";
                    echo "<a href=\" ./cartadd.php?id=" . $product["id"] . "&quantity=1\">Add to Cart</a>";
                }
                ?>
                </ul>
            </main>
        <?php
            require "assets/footer.php";
        ?>
    </body>
</html>