<?php
declare(strict_types = 1);

session_start();

require_once('../../database/connection.db.php');
require_once('../../database/category.class.php');
require_once('../../csrf_token.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
    
    if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
        $_SESSION['error_message'] = 'Invalid CSRF token.';
        header('Location: ' . htmlspecialchars($_SERVER['HTTP_REFERER']));
        exit;
    }

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);

        if ($name !== '') {
            try {
                $db = getDatabaseConnection();
                Category::removeDistrict($db, $name);
                $_SESSION['success_message'] = 'District removed successfully.';
            } catch (PDOException $e) {
                $_SESSION['error_message'] = 'Database error: ' . $e->getMessage();
            }
        } else {
            $_SESSION['error_message'] = 'Invalid district name.';
        }
    } else {
        $_SESSION['error_message'] = 'District name is required.';
    }
} else {
    $_SESSION['error_message'] = 'Invalid request method.';
}

header('Location: ' . htmlspecialchars($_SERVER['HTTP_REFERER']));
exit;
?>
