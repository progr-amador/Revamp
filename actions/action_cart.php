<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/baskets.class.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productID'])) {
    $productID = intval($_POST['productID']);

    if ($productID > 0) {
        $db = getDatabaseConnection();

        
        Baskets::saveCart($db, $_SESSION['user_id'], $productID);

        
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

// If input parameter is invalid
header("Location: ../codee/home.php");
exit();
?>
