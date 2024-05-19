<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/baskets.class.php');
require_once('../database/product.class.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = 'You need to login first.';
    header('Location: ../code/login.php');
    exit();
}

$db = getDatabaseConnection();

$cart = Baskets::getCart($db, $_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $district = filter_input(INPUT_POST, 'district', FILTER_SANITIZE_STRING);
    $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
    $door = filter_input(INPUT_POST, 'door', FILTER_SANITIZE_STRING);
    $localidade = filter_input(INPUT_POST, 'localidade', FILTER_SANITIZE_STRING);
    $postal_code = filter_input(INPUT_POST, 'postal_code', FILTER_SANITIZE_STRING);

    if ($name && $district && $street && $door && $localidade && $postal_code) {
        foreach ($cart as $product) {
            Product::setReserved(
                $db, (int)$product['productID']
            );
        }

        Baskets::emptyCart($db, $_SESSION['user_id']);

        header('Location: ../code/home.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Invalid reservation details.';
        header('Location: ../code/checkout.php'); 
        exit();
    }
} else {
    $_SESSION['error_message'] = 'Invalid request method.';
    header('Location: ../code/home.php');
    exit();
}
?>
