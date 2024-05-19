<?php
declare(strict_types = 1);

session_start();

require_once('../../database/connection.db.php');
require_once('../../database/category.class.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);

        if ($name !== '') {
            try {
                $db = getDatabaseConnection();
                Category::addCategory($db, $name);
                $_SESSION['success_message'] = 'Category added successfully.';
            } catch (PDOException $e) {
                $_SESSION['error_message'] = 'Database error: ' . $e->getMessage();
            }
        } else {
            $_SESSION['error_message'] = 'Invalid category name.';
        }
    } else {
        $_SESSION['error_message'] = 'Category name is required.';
    }
} else {
    $_SESSION['error_message'] = 'Invalid request method.';
}

header('Location: ' . htmlspecialchars($_SERVER['HTTP_REFERER']));
exit;
?>

