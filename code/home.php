<?php
  declare(strict_types = 1);

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/home.tpl.php');

  $name = "Página inicial";

  $db = getDatabaseConnection();

  $featured = Product::getFeatured($db);
  $favorites = Product::getFavorites($db);

  drawHead($name);
  drawHeader();
  drawHome($featured, $favorites);
  drawFooter();
?>