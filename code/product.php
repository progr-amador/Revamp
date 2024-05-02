<?php
  declare(strict_types = 1);

  require_once('../templates/product.tpl.php');
  require_once('../templates/common.tpl.php');

  $name = "Product";

  drawHead($name);
  drawHeader();
  drawProduct();
  drawFooter();
?>