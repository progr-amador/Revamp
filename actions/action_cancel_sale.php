<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/baskets.class.php');
require_once('../database/product.class.php');


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $productID = intval($_GET['id']);
    if ($productID > 0) {

        $db = getDatabaseConnection();
        Product::removeReserved($db, $productID);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

// If input parameter is invalid
header("Location: ../code/home.php");
exit();
?>
