<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/users.class.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $oldPassword = $_POST['old'] ?? '';
    $newPassword = $_POST['new'] ?? '';
    $password = $_POST['password'] ?? '';
    $userId = $_SESSION['user_id'] ?? null;

    
    if ($userId === null) {
        $_SESSION['error_message'] = 'No active session. Please login.';
        header('Location: ../code/login.php');
        exit();
    }

    
    $user = Users::getUser($db, $userId);

    
    if ($user && Users::getUsersWithPassword($oldEmail, $password) != null) {
        
        $success = Users::updateUserPassword($db, $userId, $newPassword);
        if ($success) {
            $_SESSION['success_message'] = 'Password successfully updated.';
            header('Location: ../code/home.php');
            exit();
        } else {
            $_SESSION['error_message'] = 'Failed to update password.';
        }
    } else {
        $_SESSION['error_message'] = 'Invalid password.';
    }

    
    header('Location: ../code/edit_profile.php?type=password');
    exit();
}

// Fallback redirection if not POST
header('Location: ../code/home.php');
exit();
?>
