<?php
declare(strict_types=1);

session_start(); // Start a new session or resume the existing one

require_once('../database/connection.db.php'); // Path to your database connection file
require_once('../database/users.class.php');
require_once('../templates/common.tpl.php');
require_once('../templates/login.tpl.php');

$name = "Login";
drawHead($name);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Attempt to retrieve the user from the database
    $user = Users::getUsersWithPassword( $email, $password);

    if ($user !== null) {
        // Password verification
        
            // Set session variables
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['logged_in'] = time();

            // Redirect to a new page (e.g., user dashboard)
            header("Location: dashboard.php");
            exit;
        
    } else {
        echo '<p>Invalid email or password.</p>';
    }
}

drawLogin();
drawFooter();
?>
