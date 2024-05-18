<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/baskets.class.php');
require_once('../database/product.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $productID = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    
    if ($productID !== false && $productID > 0) {
        $db = getDatabaseConnection();
        Product::removeReserved($db, $productID);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        $_SESSION['error_message'] = 'Invalid product ID.';
    }
}

header("Location: ../code/home.php");
exit();
?>
