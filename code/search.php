<?php
  declare(strict_types = 1);

  require_once('../templates/common.tpl.php');
  require_once('../templates/search.tpl.php');

  $name = "Search";

  drawHead($name);
  drawHeader();
  drawSearch();
  drawFooter();
?>
