<?php
declare(strict_types=1);

session_start(); 

require_once('../database/connection.db.php'); 
require_once('../database/users.class.php');
require_once('../csrf_token.php');
require_once('../templates/common.tpl.php');
require_once('../templates/edit_profile.tpl.php');

$name = "Editar Perfil";
$type = $_GET['type'] ?? 'email'; 

drawHead($name);
drawEditProfile($type); 
drawFooter();
?>
