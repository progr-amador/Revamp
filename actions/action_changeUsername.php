<?php
declare(strict_types = 1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/users.class.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldEmail = $_POST['old'] ?? '';
    $newUsername = $_POST['new'] ?? '';
    $password = $_POST['password'] ?? '';
    $userId = $_SESSION['user_id'] ?? null;

    if ($userId === null) {
        // Redirect if no user is logged in
        $_SESSION['error_message'] = 'No active session. Please login.';
        header('Location: ../code/login.php');
        exit();
    }

    // Retrieve user from database
    $user = Users::getUser($db, $userId);
    if ($user && Users::getUsersWithPassword($oldEmail, $password) != null) {
        // Check if the new email is valid (not already taken and properly formatted)
        if (Users::isUsernameAvailable($db, $newUsername)) {
            // Update the email if the password is correct and new email is valid
            $success = Users::updateUserName($db, $userId, $newUsername );
            if ($success) {
                // Update email in the session and redirect
                $_SESSION['username'] = $newUsername;
                $_SESSION['success_message'] = 'Username successfully updated.';
                header('Location: ../code/home.php');
                exit();
            } else {
                $_SESSION['error_message'] = 'Failed to update username.';
            }
        } else {
            $_SESSION['error_message'] = 'Username is already in use or invalid.';
        }
    } 
    

    // Redirect back to change email page or profile page with an error message
    header('Location: ../code/edit_profile.php?type=username');
    exit();
}

// Fallback redirection if not POST
header('Location: ../code/home.php');
exit();
?>
