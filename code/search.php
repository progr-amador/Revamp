<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');
  require_once('../database/category.class.php');
  require_once('../csrf_token.php');
  require_once('../templates/common.tpl.php');
  require_once('../templates/search.tpl.php');

  $db = getDatabaseConnection();

  $categories = Category::getCategories($db);
  $districts = Category::getDistricts($db);
  $brands = Category::getBrands($db);
  $conditions = Category::getConditions($db);

  $filters['search'] = $_GET['query'];

  $searched = Product::searchProducts($db, $filters, 20);

  drawHead("Pesquisa");
  drawHeader($_GET['query']);
  drawSearch($searched, $categories, $districts, $brands, $conditions);
  drawFooter();
?>


