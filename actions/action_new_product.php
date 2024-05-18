<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/product.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $seller = $_SESSION['user_id'] ?? 0;

    $brand = $_POST['brand'] ?? 0;
    $category = $_POST['category'] ?? 0;
    $location = $_POST['location'] ?? 0;
    $condition = $_POST['condition'] ?? 0;
    $price = $_POST['price'] ?? 0;
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';

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
            $_SESSION['error_message'] = "Error: You can upload a maximum of 4 images.";
            header('Location: ../code/new_product.php');
            exit;
        }

        for ($i = 0; $i < $numFiles; $i++) {
            $fileName = $uploadedImages['name'][$i];
            $fileTmpName = $uploadedImages['tmp_name'][$i];
            $fileError = $uploadedImages['error'][$i];

            if ($fileError === 0) {
                $destination = '../assets/products/' . uniqid() . '_' . $fileName;
                $destinations[] = $destination;

                if (!move_uploaded_file($fileTmpName, $destination)) {
                    $_SESSION['error_message'] = "Error moving uploaded file: $fileName";
                    header('Location: ../code/new_product.php');
                    exit;
                }
            } else {
                $_SESSION['error_message'] = "Error uploading file: $fileName";
                header('Location: ../code/new_product.php');
                exit;
            }
        }
    }

    try {
        $db = getDatabaseConnection();
        $newProduct->save($db, $destinations);
    } catch (PDOException $e) {

        $_SESSION['error_message'] = 'Failed to save product: ' . $e->getMessage();
        header('Location: ../code/new_product.php');
        exit;
    }
}

header('Location: ../code/home.php');
exit;
?>
