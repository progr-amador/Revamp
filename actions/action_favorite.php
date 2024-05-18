<?php
declare(strict_types = 1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/baskets.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    
    $productID = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);
    if ($productID === false || $productID === null) {
        $_SESSION['error_message'] = 'Invalid productID.';
    } else {
        
        $db = getDatabaseConnection();
        $success = Baskets::saveFavorite($db, $_SESSION['user_id'], $productID);
        if (!$success) {
            $_SESSION['error_message'] = 'Failed to save favorite.';
        }
    }
} else {
    $_SESSION['error_message'] = 'Unauthorized access.';
}

// Redirect back to the previous page or a safe location
header('Location: ../code/home.php');
exit();
?>
