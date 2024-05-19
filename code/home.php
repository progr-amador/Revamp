<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/product.class.php');
require_once('../csrf_token.php');
require_once('../templates/common.tpl.php');
require_once('../templates/home.tpl.php');

$name = "Página inicial";

$db = getDatabaseConnection();

try {
    $featured = Product::getFeatured($db);
} catch (PDOException $e) {
    $errorMessage = 'Failed to retrieve featured products: ' . $e->getMessage();
    $featured = [];
}

drawHead($name);
drawHeader();
drawHome($featured);
drawFooter();
?>
