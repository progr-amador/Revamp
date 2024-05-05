<?php 
    declare(strict_types=1);

    class Product{
      public int $id;
      public int $seller;
      public int $brand;
      public int $category;
      public int $location;
      public int $price;
      public string $title;
      public string $description;
      public int $condition;

    public function __construct(int $id,int $seller,int $brand,int $category,int $location,int $price,int $condition){
      $this->id = $id;
      $this->seller = $seller;
      $this->brand = $brand;
      $this->category = $category;
      $this->location = $location;
      $this->price = $price;
      $this->title = $title;
      $this->description = $description;
      $this->condition = $condition;
    }

    static function getFeatured(PDO $db): array{
      $stmt = $db->prepare('
        SELECT productID, title, price, locationName AS location, photoURL
        FROM PRODUCT
        JOIN LOCATION_ USING (locationID)
        JOIN PHOTO USING (productID)
        ORDER BY price ASC
        LIMIT 4
      ');

      $stmt->execute();
      $products = $stmt->fetchAll();
      return $products;
    }

    static function getFavorites(PDO $db): array{
      $stmt = $db->prepare('
        SELECT productID, title, price, locationName AS location, photoURL
        FROM PRODUCT
        JOIN LOCATION_ USING (locationID)
        JOIN PHOTO USING (productID)
        ORDER BY price DESC
        LIMIT 3
      ');

      $stmt->execute();
      $products = $stmt->fetchAll();
      return $products;
    }

    static function getSearched(PDO $db, string $search): array {
      $stmt = $db->prepare('
        SELECT productID, title, price, locationName AS location, photoURL
        FROM PRODUCT
        JOIN LOCATION_ USING (locationID)
        JOIN PHOTO USING (productID)
        WHERE title LIKE ?
        ORDER BY price ASC
      ');
  
      $stmt->execute(array("%$search%")); 
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the results
      return $products;
    }

    static function getCategory(PDO $db, string $category): array {
      $stmt = $db->prepare('
        SELECT productID, title, price, locationName AS location, photoURL, categoryName
        FROM PRODUCT
        JOIN LOCATION_ USING (locationID)
        JOIN PHOTO USING (productID)
        JOIN CATEGORY USING (categoryID)
        WHERE categoryName LIKE ?
        ORDER BY price ASC
      ');
  
      $stmt->execute(array("%$category%")); 
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the results
      return $products;
    }

    

    static function getProductSeller(PDO $db, int$id): array{
        $stmt = $db->prepare('
        SELECT productId, sellerID, brandID, categoryID, locationID, title, description, price, condition
        FROM PRODUCT 
        JOIN USERS ON PRODUCT.sellerID=USERS.userID
        JOIN BRAND USING (brandID)
        JOIN CATEGORY USING (categoryID)
        JOIN LOCATION_ USING (locationID)
        WHERE SellerId = ?
        GROUP BY productID
      ');

      $stmt->execute(array($id));
  
      $products = array();
  
      while ($prod = $stmt->fetch()) {
        $products[] = new Product(
          $prod['productId'], 
          $prod['sellerId'],
          $prod['brandId'],
          $prod['categoryId'],
          $prod['locationId'],
          $prod['title'],
          $prod['description'],
          $prod['price'],
          $prod['condition'],
        );
        }

        return $products;
    }

    static function getProduct(PDO $db, $id): array{
        $stmt = $db->prepare('
        SELECT productId, sellerID, brandID, categoryID, product.locationID, title, description, price, condition, photoURL, username AS seller, locationName AS location
        FROM PRODUCT 
        JOIN USERS ON PRODUCT.sellerID=USERS.userID
        JOIN BRAND USING (brandID)
        JOIN CATEGORY USING (categoryID)
        JOIN LOCATION_ USING (locationID)
        JOIN PHOTO USING (productID)
        WHERE ProductId = ?
        GROUP BY productID
      ');

      $stmt->execute(array($id));

      // Fetch a single row
      $product = $stmt->fetch(PDO::FETCH_ASSOC);

      // Return the product data
      return $product;
    }
  }

?>