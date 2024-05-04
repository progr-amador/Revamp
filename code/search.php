<?php
  declare(strict_types = 1);

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/search.tpl.php');

  $db = getDatabaseConnection();

  $query = $_GET['query'];

  $searched = Product::getSearched($db, $query);

  $name = "Search";

  

  drawHead($name);
  drawHeader();
  drawSearch($searched);
  drawFooter();
?>
