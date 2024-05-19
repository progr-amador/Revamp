<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');
  require_once('../database/users.class.php');
  require_once('../templates/common.tpl.php');
  require_once('../templates/profile.tpl.php');
  require_once('../csrf_token.php');

  $name = "Perfil";

  $db = getDatabaseConnection();
  $userID = intval($_GET['id']);
  $listings = Product::getUserListings($db, $userID);
  $user = Users::getUser($db, $userID);

  drawHead($name);
  drawHeader();
  drawProfile($listings, $user);
  drawFooter();
?>