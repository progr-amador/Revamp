<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/users.class.php');



// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $email = $_POST['old'] ?? '';
    $oldPassword = $_POST['password'] ?? '';
    $newPassword = $_POST['new'] ?? '';
    $userId = $_SESSION['user_id'] ?? null;

    // Redirect if there's no active session
    if ($userId === null) {
        $_SESSION['error_message'] = 'No active session. Please login.';
        header('Location: ../code/login.php');
        exit();
    }

    $db = getDatabaseConnection();
    $user = Users::getUserByEmail($db, $email);

    
    if ($user && password_verify($oldPassword, $user['hashedPassword'])) {
        
        if (strlen($newPassword) < 8 || !preg_match('/[A-Z]/', $newPassword) || !preg_match('/[a-z]/', $newPassword) || !preg_match('/[0-9]/', $newPassword)) {
            $_SESSION['error_message'] = 'New password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one digit.';
            header('Location: ../code/edit_profile.php?type=password');
            exit();
        }

        $success = Users::updateUserPassword($db, $userId, $newPassword);
        if ($success) {
            $_SESSION['success_message'] = 'Password successfully updated.';
            header('Location: ../code/home.php');
            exit();
        } else {
            $_SESSION['error_message'] = 'Failed to update password.';
        }
    } else {
        $_SESSION['error_message'] = 'Invalid credentials.';
    }

    header('Location: ../code/edit_profile.php?type=password');
    exit();
}

header('Location: ../code/home.php');
exit();
?>
