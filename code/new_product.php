<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/category.class.php');
  require_once('../templates/common.tpl.php');
  require_once('../templates/new_product.tpl.php');
  require_once('../csrf_token.php');

  $db = getDatabaseConnection();
  $name = 'Novo Produto';

  $districts = Category::getDistricts($db);
  $categories = Category::getCategories($db);
  $brands = Category::getBrands($db);
  $conditions = Category::getConditions($db);

  drawHead($name);
  drawHeader();
  drawNewProduct($districts, $categories, $brands, $conditions);
  drawFooter();
?>