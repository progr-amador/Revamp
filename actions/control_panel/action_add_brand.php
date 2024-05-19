<?php
declare(strict_types = 1);

session_start();

require_once('../../database/connection.db.php');
require_once('../../database/category.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    
    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = filter_var(trim($_POST['name']), FILTER_UNSAFE_RAW);

        if ($name !== '') {
            try {
                $db = getDatabaseConnection();
                Category::addBrand($db, $name);
                $_SESSION['success_message'] = 'Brand added successfully.';
            } catch (PDOException $e) {
                $_SESSION['error_message'] = 'Database error: ' . $e->getMessage();
            }
        } else {
            $_SESSION['error_message'] = 'Invalid brand name.';
        }
    } else {
        $_SESSION['error_message'] = 'Brand name is required.';
    }
} else {
    $_SESSION['error_message'] = 'Invalid request method.';
}

header('Location: ' . htmlspecialchars($_SERVER['HTTP_REFERER']));
exit;
?>
