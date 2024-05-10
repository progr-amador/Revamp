<?php
  declare(strict_types = 1);

  session_start();

  require_once('../database/connection.db.php');
  require_once('../database/product.class.php');
  require_once('../database/category.class.php');

  require_once('../templates/common.tpl.php');
  require_once('../templates/search.tpl.php');

  $db = getDatabaseConnection();

  $query = $_GET['query'];

  $categories = Category::getCategories($db);
  $districts = Category::getDistricts($db);
  $brands = Category::getBrands($db);

  $name = "Pesquisa";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $title = $_GET['title'] ?? $query;
    $price_min = $_GET["price_min"] ?? "";
    $price_max = $_GET["price_max"] ?? "";
    $condition = $_GET["condition"] ?? "";
    $district = $_GET["district"] ?? "";
    $category = $_GET["category"] ?? "";
    $brand = $_GET["brand"] ?? "";
    

    // Call the getFiltered function with the form values
    $searched = Product::getFiltered($db, $title, $price_min, $price_max, $condition, $district, $category, $brand);

    // Process the filtered products, display them, etc.
  }

  drawHead($name);
  drawHeader();
  drawSearch($searched, $categories, $districts, $brands, $query);
  drawFooter();
?>


