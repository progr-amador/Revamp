<?php
  declare(strict_types = 1);

  require_once('../templates/common.tpl.php');
  require_once('../templates/register.tpl.php');

  $name = "Registo";

  drawHead($name);
  drawRegister();
  drawFooter();
?>