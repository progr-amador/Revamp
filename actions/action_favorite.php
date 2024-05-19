<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/baskets.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['error_message'] = 'You need to login first.';
        header('Location: ../code/login.php');
        exit();
    }

    $productID = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);
    if ($productID === false || $productID === null) {
        $_SESSION['error_message'] = 'Invalid product ID.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $db = getDatabaseConnection();

    $success = Baskets::saveFavorite($db, $_SESSION['user_id'], $productID);
    if (!$success) {
        $_SESSION['error_message'] = 'Failed to save favorite.';
    } else {
        $_SESSION['success_message'] = 'Product added to favorites successfully.';
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

$_SESSION['error_message'] = 'Unauthorized access.';
header('Location: ../code/home.php');
exit();
?>
