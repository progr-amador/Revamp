<?php
declare(strict_types=1);

session_start(); // Start a new session or resume the existing one

require_once('../database/connection.db.php'); // Path to your database connection file
require_once('../database/users.class.php');

require_once('../templates/common.tpl.php');
require_once('../templates/login.tpl.php');

$name = "Iniciar Sessão";

drawHead($name);
drawLogin();
drawFooter();
?>
