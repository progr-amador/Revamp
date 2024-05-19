<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/users.class.php');
require_once('../csrf_token.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
        $_SESSION['error_message'] = 'Invalid CSRF token.';
        header('Location: ../code/login.php');
        exit();
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

    if ($email !== false && $password !== false) {
        $db = getDatabaseConnection();
        $user = Users::getUserByEmail($db, $email);
        
        if ($user && password_verify($password, $user['hashedPassword'])) {

            $_SESSION['user_id'] = intval($user['userID']);
            $_SESSION['user_name'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['creationDate'] = $user['creationDate'];
            $_SESSION['admin'] = $user['isAdmin'];

            header('Location: ../code/home.php');
            exit();
        }
    }

    $_SESSION['error_message'] = 'Invalid email or password.';
    header('Location: ../code/login.php');
    exit();
}

header('Location: ../code/login.php');
exit();
?>
