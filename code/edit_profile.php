<?php
declare(strict_types=1);

session_start(); // Start or resume a session

require_once('../database/connection.db.php'); // Include database connection
require_once('../database/users.class.php');

require_once('../templates/common.tpl.php');
require_once('../templates/edit_profile.tpl.php');

$name = "Editar Perfil";
$type = $_GET['type'] ?? 'email'; // Default to editing email if no type is specified

drawHead($name);
drawEditProfile($type); // Pass the type to the function
drawFooter();
?>
