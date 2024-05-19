<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/product.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $filters = [];

    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING) ?? 
              filter_input(INPUT_GET, 'query', FILTER_SANITIZE_STRING);
    if ($search) {
        $filters['search'] = $search;
    }

    $filterParams = [
        'condition' => FILTER_SANITIZE_STRING,
        'district' => FILTER_SANITIZE_STRING,
        'category' => FILTER_SANITIZE_STRING,
        'brand' => FILTER_SANITIZE_STRING,
        'order' => FILTER_SANITIZE_STRING,
        'price_min' => FILTER_VALIDATE_INT,
        'price_max' => FILTER_VALIDATE_INT
    ];

    foreach ($filterParams as $param => $filter) {
        $value = filter_input(INPUT_GET, $param, $filter);
        if ($value !== null) {
            $filters[$param] = $value;
        }
    }

    try {
        $db = getDatabaseConnection();
        $products = Product::searchProducts($db, $filters, 20);

        header('Content-Type: application/json');
        echo json_encode($products);
        exit;
    } catch (PDOException $e) {
        error_log('Failed to search for products: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Failed to search for products.']);
        exit;
    }
}

header('Content-Type: application/json');
echo json_encode([]);
?>
