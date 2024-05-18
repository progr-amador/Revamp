<?php
declare(strict_types = 1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/baskets.class.php');
require_once('../database/product.class.php');

$db = getDatabaseConnection();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = 'You need to login first.';
    header('Location: ../code/login.php');
    exit();
}

$cart = Baskets::getCart($db, $_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    foreach ($cart as $product) {
        Product::setReserved($db, (int) $product['productID']);
    }
    
    Baskets::emptyCart($db, $_SESSION['user_id']);
    
    header('Location: ../code/home.php');
    exit();
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>
