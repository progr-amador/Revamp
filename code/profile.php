<?php
  declare(strict_types = 1);

  require_once('../templates/common.tpl.php');
  require_once('../templates/profile.tpl.php');

  $name = "Profile";

  drawHead($name);
  drawProfile();
  drawFooter();
?>