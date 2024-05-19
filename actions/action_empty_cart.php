<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/baskets.class.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = 'User is not logged in.';
    header('Location: ../code/login.php');
    exit();
}

try {
    $db = getDatabaseConnection();
    Baskets::emptyCart($db, $_SESSION['user_id']);

    $_SESSION['success_message'] = 'Cart emptied successfully.';
} catch (PDOException $e) {
    $_SESSION['error_message'] = 'Failed to empty the cart: ' . $e->getMessage();
}

header('Location: ../code/home.php');
exit();
?>
