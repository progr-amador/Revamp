<?php
declare(strict_types=1);

session_start();

if ((!isset($_SESSION['user_id'])) || (!$_SESSION['admin'])) {
    header('Location: ../code/home.php');
    exit;
}

require_once('../csrf_token.php');
require_once('../templates/common.tpl.php');
require_once('../templates/control_panel.tpl.php');

$name = "Painel de Controlo";

drawHead($name);
drawHeader();
drawControlPanel();
drawFooter();
?>
