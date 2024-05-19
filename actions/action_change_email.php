<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/users.class.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $oldEmail = filter_var(trim($_POST['old'] ?? ''), FILTER_SANITIZE_EMAIL);
    $newEmail = filter_var(trim($_POST['new'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId === null) {
        $_SESSION['error_message'] = 'No active session. Please login.';
        header('Location: ../code/login.php');
        exit();
    }

    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = 'Invalid email format.';
        header('Location: ../code/edit_profile.php?type=email');
        exit();
    }

    $db = getDatabaseConnection();
    $user = Users::getUserByEmail($db, $oldEmail);

    if ($user && password_verify($password, $user['hashedPassword'])) {
        
        if (Users::isEmailAvailable($db, $newEmail)) {
            
            $success = Users::updateUserEmail($db, $userId, $newEmail);
            if ($success) {
                
                $_SESSION['email'] = $newEmail;
                $_SESSION['success_message'] = 'Email successfully updated.';
                header('Location: ../code/home.php');
                exit();
            } else {
                $_SESSION['error_message'] = 'Failed to update email.';
            }
        } else {
            $_SESSION['error_message'] = 'Email is already in use or invalid.';
        }
    } else {
        $_SESSION['error_message'] = 'Invalid credentials.';
    }

    header('Location: ../code/edit_profile.php?type=email');
    exit();
}

header('Location: ../code/home.php');
exit();
?>
