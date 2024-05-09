<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');

require_once('../database/users.class.php'); // Assuming this is the path to your Users class
require_once('../templates/common.tpl.php');
require_once('../templates/register.tpl.php');

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';

    // Assuming $db is your PDO connection
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $newUser = new Users(0, $username, $email, '', '', '', '', false);
    // You'd normally add more validation and error handling here

    $newUser->save($db, $hashedPassword);  // Save the user
}

$name = "Registo";

drawHead($name);
drawRegister(); // This function should display your form
drawFooter();
?>
