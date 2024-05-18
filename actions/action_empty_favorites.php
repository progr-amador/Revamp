<?php
declare(strict_types = 1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/baskets.class.php');

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error_message'] = 'You need to login first.';
    header('Location: ../code/login.php');
    exit();
}

$db = getDatabaseConnection();

Baskets::emptyFavorites($db, $_SESSION['user_id']);

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
?>
