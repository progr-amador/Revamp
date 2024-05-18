<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/product.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $search = '';
    $filters = [];

    if (isset($_GET['search']) || isset($_GET['query'])) {
        $search = $_GET['search'] ?? $_GET['query'];
    }
    $filters['search'] = $search;

    $filterParams = ['condition', 'district', 'category', 'brand', 'order', 'price_min', 'price_max'];
    foreach ($filterParams as $param) {
        if (isset($_GET[$param])) {
            $filters[$param] = $_GET[$param];
        }
    }

    $db = getDatabaseConnection();

    try {
        $products = Product::searchProducts($db, $filters, 20);
        echo json_encode($products);
        exit;
    } catch (PDOException $e) {

        $errorMessage = 'Failed to search for products: ' . $e->getMessage();
        echo json_encode(['error' => $errorMessage]);
        exit;
    }
}

echo json_encode([]);
?>
