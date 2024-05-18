<?php
declare(strict_types = 1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/users.class.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $oldEmail = $_POST['old'] ?? '';
    $newUsername = filter_input(INPUT_POST, 'new', FILTER_SANITIZE_STRING);
    $password = $_POST['password'] ?? '';
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId === null) {
        
        $_SESSION['error_message'] = 'No active session. Please login.';
        header('Location: ../code/login.php');
        exit();
    }

    $user = Users::getUser($db, $userId);
    
    if ($user && Users::getUsersWithPassword($oldEmail, $password) != null) {
        
        if (!empty($newUsername) && Users::isUsernameAvailable($db, $newUsername)) {
            
            $success = Users::updateUserName($db, $userId, $newUsername);
            if ($success) {
                
                $_SESSION['username'] = $newUsername;
                $_SESSION['success_message'] = 'Username successfully updated.';
                header('Location: ../code/home.php');
                exit();
            } else {
                $_SESSION['error_message'] = 'Failed to update username.';
            }
        } else {
            $_SESSION['error_message'] = 'Invalid or already existing username.';
        }
    } else {
        $_SESSION['error_message'] = 'Invalid password.';
    }

    header('Location: ../code/edit_profile.php?type=username');
    exit();
}

// Redirect to home page if not a POST request
header('Location: ../code/home.php');
exit();
?>
