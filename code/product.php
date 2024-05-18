<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');
  require_once('../database/photo.class.php');

  require_once('../templates/product.tpl.php');
  require_once('../templates/common.tpl.php');

  $name = "Produto";
  $db = getDatabaseConnection();
  $ID = intval($_GET['id']);

  $product = Product::getProduct($db, $ID);
  $photos = Photo::getProductPhotos($db, $ID);

  drawHead($name);
  drawHeader();
  drawProduct($product, $ID, $photos);
  drawFooter();
?>