<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');
  require_once('../templates/common.tpl.php');
  require_once('../templates/home.tpl.php');
  require_once('../templates/profile.tpl.php');
  

  $name = "Perfil";

  $db = getDatabaseConnection();
  $userID = null;
  $listings = Product::getUserListings($db, $_SESSION['user_id']);

  drawHead($name);
  drawHeader();
  drawProfile($listings);
  drawFooter();
?>