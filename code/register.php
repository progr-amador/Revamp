<?php
declare(strict_types=1);

session_start();

require_once('../csrf_token.php');
require_once('../templates/common.tpl.php');
require_once('../templates/register.tpl.php');

$name = "Registo";

drawHead($name);
drawRegister();
drawFooter();
?>
