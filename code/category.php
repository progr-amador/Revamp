<?php
  declare(strict_types = 1);

  require_once('../templates/common.tpl.php');
  require_once('../templates/category.tpl.php');

  $name = "Home";
  $category = "Telemóveis";

  drawHead($name);
  drawHeader();
  drawCategory($category);
  drawFooter();
?>