<?php
    declare(strict_types = 1);

    session_start();

    require_once('../database/connection.db.php');
    require_once('../database/baskets.class.php');
    require_once('../database/product.class.php');

    $db = getDatabaseConnection();
    $cart = Baskets::getCart($db, $_SESSION['user_id']);

    $name = $_POST['name'];
    $district = $_POST['district'];
    $street = $_POST['street'];
    $door = $_POST['door'];
    $localidade = $_POST['localidade'];
    $postal_code = $_POST['postal_code'];

    foreach ($cart as $product) {
      Product::setReserved($db, intval($product['productID']), $name, $district, $street, $door, $localidade, $postal_code);
    }

    Baskets::emptyCart($db, $_SESSION['user_id']);

    header('Location: ../code/home.php');
?>