<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/users.class.php');

  $db = getDatabaseConnection();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Attempt to retrieve the user from the database
    $user = Users::getUsersWithPassword($email, $password);

    if ($user) {
        // Password verification
        
            // Set session variables
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['email'] = $user->email;
        
    } else {
        echo '<p>Invalid email or password.</p>';
    }
}

header('Location: ../code/home.php');
?>