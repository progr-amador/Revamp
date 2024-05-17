<?php
declare(strict_types = 1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/users.class.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = Users::getUsersWithPassword($email, $password);

    if ($user) {
        // Assuming you have a method to verify the password
        
            // Set session variables
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['email'] = $user->email;
            $_SESSION['creationDate'] = $user->date;
            $_SESSION['admin'] = $user->isAdmin;
            // Redirect to home page if the login is successful
            header('Location: ../code/home.php');
            exit();
        
    }

    // Set an error message in $_SESSION if login fails
    $_SESSION['error_message'] = 'Invalid email or password.';
    // Redirect back to the login page or another appropriate page
    header('Location: ../code/login.php');
    exit();
}

// Fallback redirection
header('Location: ../code/login.php');
exit();
?>
