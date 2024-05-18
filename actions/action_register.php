<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/users.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (!empty($username) && !empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $db = getDatabaseConnection();

        $newUser = new Users($username, $email);

        $newUser->save($db, $password);

        header('Location: ../code/login.php');
        exit();
    }
}

// If input parameters are invalid
header("Location: ../code/home.php");
exit();
?>
