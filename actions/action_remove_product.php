<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/product.class.php');
require_once('../csrf_token.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $productID = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);
    $whereTo = filter_input(INPUT_POST, 'whereTo', FILTER_UNSAFE_RAW);

    if ($productID === false || $productID === null || empty($whereTo)) {
        $_SESSION['error_message'] = 'Invalid product ID or destination.';
        header('Location: ../code/home.php');
        exit();
    }

    try {
        $db = getDatabaseConnection();
        Product::removeProduct($db, $productID);

        if ($whereTo === 'home') {
            header('Location: ../code/home.php');
        } else {
            header('Location: ../code/reserved.php');
        }
        exit();
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Failed to remove product: ' . $e->getMessage();
        if ($whereTo === 'home') {
            header('Location: ../code/home.php');
        } else {
            header('Location: ../code/reserved.php');
        }
        exit();
    }
}

header('Location: ../code/home.php');
exit();
?>
