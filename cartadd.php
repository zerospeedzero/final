<?php
    session_start();
    $id = $_GET["id"];
    $quantity = $_GET["quantity"];
    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }
    if ($quantity != 0) {
        $_SESSION["cart"][$id] = intval($quantity);
    } else {
        $_SESSION["cart"][$id] = null;
        unset($_SESSION["cart"][$id]);
    }
    header("Location:./cart.php")
?>