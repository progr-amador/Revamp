<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/my_listings.tpl.php');

  $db = getDatabaseConnection();
  $name = "Meus Produtos";

  $listings = Product::getMyListings($db, $_SESSION['user_id']);

  drawHead($name);
  drawHeader();
  drawMyListings($listings);
  drawFooter();
?>