<?php
declare(strict_types=1);

session_start();

require_once('../database/connection.db.php');
require_once('../database/users.class.php'); // Assuming this is the path to your Users class

require_once('../templates/common.tpl.php');
require_once('../templates/register.tpl.php');

$db = getDatabaseConnection();

$name = "Registo";

drawHead($name);
drawRegister(); // This function should display your form
drawFooter();
?>
