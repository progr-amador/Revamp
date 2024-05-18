<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/users.class.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Trim and sanitize input data
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

    $user = Users::getUser($db, $userId);

    // Check if the user exists and password is correct
    if ($user && password_verify($password, $user['hashedPassword'])) {
        // Check if the new email is available
        if (Users::isEmailAvailable($db, $newEmail)) {
            // Update the email address
            $success = Users::updateUserEmail($db, $userId, $newEmail);
            if ($success) {
                // Update email in the session and redirect
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
        $_SESSION['error_message'] = 'Invalid password.';
    }

    // Redirect back to change email page or profile page with an error message
    header('Location: ../code/edit_profile.php?type=email');
    exit();
}

// Fallback redirection if not POST
header('Location: ../code/home.php');
exit();
?>

