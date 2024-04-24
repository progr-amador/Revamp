<?php
  declare(strict_types = 1);

  require_once('../templates/common.tpl.php');
  require_once('../templates/login.tpl.php');

  $name = "Login";

  drawHead($name);
  drawLogin();
  drawFooter();
?>