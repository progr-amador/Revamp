<?php 
    declare(strict_types=1);

    class Product{
      public int $id;
      public int $seller;
      public int $brand;
      public int $category;
      public int $location;
      public int $condition;
      public int $price;
      public string $title;
      public string $description;

    public function __construct(int $seller,int $brand,int $category,int $location,int $condition,int $price,string $title, string $description,int $id = 0){
      $this->id = $id;
      $this->seller = $seller;
      $this->brand = $brand;
      $this->category = $category;
      $this->location = $location;
      $this->condition = $condition;
      $this->price = $price;
      $this->title = $title;
      $this->description = $description;
    }

    public function save(PDO $db, $path) {
      $stmt = $db->prepare('
        INSERT INTO PRODUCT (sellerID, brandID, categoryID, locationID, conditionID, title, description, price) 
        VALUES (?,?,?,?,?,?,?,?) 
      ');

      $stmt->execute([
        $this->seller,
        $this->brand,
        $this->category,
        $this->location,
        $this->condition,
        $this->title,
        $this->description,
        $this->price,
      ]);

      $productID = $db->lastInsertId();

      $stmt = $db->prepare('
        INSERT INTO PHOTO (productID, photoURL) VALUES
        (?, ?) 
      ');

      $stmt->execute([$productID, $path]);
    } 

    static function getFiltered(PDO $db, string $title = '', string $price_min = '', string $price_max = '', string $condition = '', string $district = '', string $category = '', string $brand = ''): array {
      // Start building the query
      $query = '
          SELECT productID, title, price, locationName AS location, photoURL
          FROM PRODUCT
          JOIN LOCATION_ USING (locationID)
          JOIN PHOTO USING (productID)
          JOIN CATEGORY USING (categoryID)
          JOIN BRAND USING (brandID)
          JOIN CONDITION USING (conditionID)
          WHERE 1=1 '; // 1=1 always true, acts as a starting point for further conditions
  
      $params = array(); // Array to hold parameters for execution
  
      // Add conditions based on provided parameters
      if (!empty($title)) {
          $query .= 'AND title LIKE ? ';
          $params[] = "%$title%";
      }
      if (!empty($price_min)) {
          $price_min = intval($price_min);
          $query .= 'AND price >= ? ';
          $params[] = $price_min;
      }
      if (!empty($price_max)) {
          $price_max = intval($price_max);
          $query .= 'AND price <= ? ';
          $params[] = $price_max;
      }
      if (!empty($condition)) {
          $query .= 'AND conditionName = ? ';
          $params[] = $condition;
      }
      if (!empty($district)) {
          $query .= 'AND locationName = ? ';
          $params[] = $district;
      }
      if (!empty($category)) {
          $query .= 'AND categoryName = ? ';
          $params[] = $category;
      }
      if (!empty($brand)) {
          $query .= 'AND brandName = ? ';
          $params[] = $brand;
      }
  
      $query .= 'ORDER BY price ASC'; // Add the final ordering
  
      $stmt = $db->prepare($query);
      $stmt->execute($params); 
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the results
      return $products;
  }

  static function getFeatured(PDO $db): array{
    $stmt = $db->prepare('
      SELECT productID, title, price, locationName AS location, photoURL
      FROM PRODUCT
      JOIN LOCATION_ USING (locationID)
      JOIN PHOTO USING (productID)
      ORDER BY price ASC
      LIMIT 20
    ');

    $stmt->execute();
    $featured = $stmt->fetchAll();
    return $featured;
  }

  static function getFavorites(PDO $db, $userID): array{
    $stmt = $db->prepare( '
      SELECT productID, title, price, locationName AS location, photoURL
      FROM PRODUCT
      JOIN LOCATION_ USING (locationID)
      JOIN PHOTO USING (productID)
      JOIN FAVORITES USING (productID)
      WHERE buyerID = ?
    ');

    $stmt->execute(array($userID));
    $favorites = $stmt->fetchAll();
    return $favorites;
  }

  static function getCart(PDO $db, $userID): array{
    $stmt = $db->prepare( '
      SELECT productID, title, price, locationName AS location, photoURL
      FROM PRODUCT
      JOIN LOCATION_ USING (locationID)
      JOIN PHOTO USING (productID)
      JOIN CART USING (productID)
      WHERE buyerID = ?
    ');

    $stmt->execute(array($userID));
    $favorites = $stmt->fetchAll();
    return $favorites;
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

    static function getProduct(PDO $db, $id): array{
        $stmt = $db->prepare('
        SELECT productID, sellerID, brandID, categoryID, product.locationID, title, description, price, conditionName AS condition, photoURL, username AS seller, locationName AS location
        FROM PRODUCT 
        JOIN USERS ON PRODUCT.sellerID=USERS.userID
        JOIN BRAND USING (brandID)
        JOIN CATEGORY USING (categoryID)
        JOIN LOCATION_ USING (locationID)
        JOIN PHOTO USING (productID)
        JOIN CONDITION USING (conditionID)
        WHERE productId = ?
        GROUP BY productID
      ');

      $stmt->execute(array($id));

      // Fetch a single row
      $product = $stmt->fetch(PDO::FETCH_ASSOC);

      // Return the product data
      return $product;
    }

    static function getUserListings(PDO $db, int $userID): array {
      $stmt = $db->prepare('
        SELECT productID, title, price, locationName AS location, photoURL, categoryName, sellerID
        FROM PRODUCT
        JOIN LOCATION_ USING (locationID)
        JOIN PHOTO USING (productID)
        JOIN CATEGORY USING (categoryID)
        WHERE sellerID LIKE ?
      ');
  
      $stmt->execute(array($userID)); 
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the results
      return $products;
    }

    static function removeProduct(PDO $db, int $productID) {
      $stmt = $db->prepare('DELETE FROM PRODUCT WHERE productID = ?');
      $stmt->execute([$productID]);
    }
  }

?>