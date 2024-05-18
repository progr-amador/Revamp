<?php
    declare(strict_types=1);

    session_start();

    require_once('../database/connection.db.php');
    require_once('../database/product.class.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productID = $_POST['productID'];
        $whereTo = $_POST['whereTo'];

        if($whereTo === 'home'){
            if (!is_numeric($productID)) {
                $_SESSION['error_message'] = 'Invalid product ID.';
                header('Location: ../code/home.php');
                exit;
            }
    
            try {
                $db = getDatabaseConnection();
                Product::removeProduct($db, intval($productID));
            } catch (PDOException $e) {
    
                $_SESSION['error_message'] = 'Failed to remove product: ' . $e->getMessage();
                header('Location: ../code/home.php');
                exit;
            }
        } else {
            if (!is_numeric($productID)) {
                $_SESSION['error_message'] = 'Invalid product ID.';
                header('Location: ../code/reserved.php');
                exit;
            }
    
            try {
                $db = getDatabaseConnection();
                Product::removeProduct($db, intval($productID));
            } catch (PDOException $e) {
    
            $_SESSION['error_message'] = 'Failed to remove product: ' . $e->getMessage();
                header('Location: ../code/reserved.php');
                exit;
            }
        }
        
        if (!is_numeric($productID)) {
            $_SESSION['error_message'] = 'Invalid product ID.';
            header('Location: ../code/home.php');
            exit;
        }

        try {
            $db = getDatabaseConnection();
            Product::removeProduct($db, intval($productID));
        } catch (PDOException $e) {

            $_SESSION['error_message'] = 'Failed to remove product: ' . $e->getMessage();
            header('Location: ../code/home.php');
            exit;
        }
    }

    header('Location: ../code/home.php');
?>
