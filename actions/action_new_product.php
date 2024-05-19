<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/product.class.php');
require_once('../csrf_token.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
        $_SESSION['error_message'] = 'Invalid CSRF token.';
        header('Location: ../code/new_product.php');
        exit();
    }

    $seller = $_SESSION['user_id'] ?? 0;
    if ($seller === 0) {
        $_SESSION['error_message'] = 'No active session. Please login.';
        header('Location: ../code/login.php');
        exit();
    }

    $brand = filter_input(INPUT_POST, 'brand', FILTER_VALIDATE_INT);
    $category = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
    $location = filter_input(INPUT_POST, 'location', FILTER_VALIDATE_INT);
    $condition = filter_input(INPUT_POST, 'condition', FILTER_VALIDATE_INT);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

    if (!$brand || !$category || !$location || !$condition || !$price || !$title || !$description) {
        $_SESSION['error_message'] = 'All fields are required.';
        header('Location: ../code/new_product.php');
        exit();
    }

    $newProduct = new Product(
        intval($seller),
        intval($brand),
        intval($category),
        intval($location),
        intval($condition),
        intval($price),
        $title,
        $description
    );

    $destinations = [];

    if (isset($_FILES['image'])) {
        $uploadedImages = $_FILES['image'];
        $numFiles = count($uploadedImages['name']);

        if ($numFiles > 4) {
            $_SESSION['error_message'] = 'You can upload a maximum of 4 images.';
            header('Location: ../code/new_product.php');
            exit();
        }

        for ($i = 0; $i < $numFiles; $i++) {
            $fileName = basename($uploadedImages['name'][$i]);
            $fileTmpName = $uploadedImages['tmp_name'][$i];
            $fileError = $uploadedImages['error'][$i];

            if ($fileError === 0) {
                $destination = '../assets/products/' . uniqid('', true) . '_' . $fileName;
                if (move_uploaded_file($fileTmpName, $destination)) {
                    $destinations[] = $destination;
                } else {
                    $_SESSION['error_message'] = "Error moving uploaded file: $fileName";
                    header('Location: ../code/new_product.php');
                    exit();
                }
            } else {
                $_SESSION['error_message'] = "Error uploading file: $fileName";
                header('Location: ../code/new_product.php');
                exit();
            }
        }
    }

    try {
        $db = getDatabaseConnection();
        $newProduct->save($db, $destinations);
        $_SESSION['success_message'] = 'Product successfully added.';
        header('Location: ../code/home.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Failed to save product: ' . $e->getMessage();
        header('Location: ../code/new_product.php');
        exit();
    }
}

header('Location: ../code/home.php');
exit();
?>
