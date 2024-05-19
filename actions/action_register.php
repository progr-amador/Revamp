<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/users.class.php');
require_once('../csrf_token.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['csrf_token']) || !validateCsrfToken($_POST['csrf_token'])) {
        $_SESSION['error_message'] = 'Invalid CSRF token.';
        header('Location: ../code/register.php');
        exit();
    }

    $username = filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW);
    $password = $_POST['password'];
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);


    if (empty($username) || empty($password) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = 'Invalid input. Please check your details and try again.';
        header('Location: ../code/register.php');
        exit();
    }

    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $_SESSION['error_message'] = 'New password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one digit.';
        header('Location: ../code/register.php');
        exit();
    }

    try {
        $db = getDatabaseConnection();

        if (!Users::isUsernameAvailable($db, $username)) {
            $_SESSION['error_message'] = 'Username already exists. Please choose another one.';
            header('Location: ../code/register.php');
            exit();
        }

        if (!Users::isEmailAvailable($db, $email)) {
            $_SESSION['error_message'] = 'Email is already in use. Please use a different email.';
            header('Location: ../code/register.php');
            exit();
        }

        $newUser = new Users($username, $email);
        $newUser->save($db, $password);

        $_SESSION['success_message'] = 'Registration successful. Please log in.';
        header('Location: ../code/login.php');
        exit();
    } catch (PDOException $e) {
        $_SESSION['error_message'] = 'Failed to register: ' . $e->getMessage();
        header('Location: ../code/register.php');
        exit();
    }
}

header('Location: ../code/home.php');
exit();
?>
