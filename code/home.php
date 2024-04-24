<?php
  declare(strict_types = 1);

  require_once('../templates/common.tpl.php');
  require_once('../templates/home.tpl.php');

  $name = "Home";

  drawHead($name);
  drawHeader();
  drawHome();
  drawFooter();
?>