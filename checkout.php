<?php
  session_start();
  require "assets/database.php";
  $products = "";
  $conn = connect();
  foreach ($_SESSION["cart"] as $id => $quantity) {
    $products = $id . ',' . $products;
  }
  // echo "insert into orders (customer, email, products, price) VALUES ('" . $_POST['customer'] . "','" . $_POST['email'] . "','" . $products . "','" . $_POST['total'] . "')";
  $r = mysqli_query($conn, "insert into orders (customer, email, products, price) VALUES ('" . $_POST['customer'] . "','" . $_POST['email'] . "','" . $products . "','" . $_POST['total'] . "')");
  // var_dump($r);
  // echo mysqli_error($conn);
  unset($_SESSION["cart"]);
  header("Location: ./index.php");
?>
