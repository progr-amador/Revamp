<?php 
    declare(strict_types=1);

    class Product{
        public int $id;
        public int $seller;
        public int $brand;
        public int $category;
        public int $location;
        public int $price;
        public int $condition;

    public function __construct(int $id,int $seller,int $brand,int $category,int $location,int $price,int $condition){
      $this->id = $id;
      $this->seller = $seller;
      $this->brand = $brand;
      $this->category = $category;
      $this->location = $location;
      $this->price = $price;
      $this->condition = $condition;
    }

    static function getProductSeller(PDO $db, int$id): array{
        $stmt = $db->prepare('
        SELECT productId, sellerID, brandID, categoryID, locationID, title, description, price, condition
        FROM PRODUCT 
        JOIN USERS ON PRODUCT.sellerID=USERS.userID
        JOIN BRAND USING (brandID)
        JOIN CATEGORY USING (categoryID)
        JOIN LOCATION USING (locationID)
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

    static function getProduct(PDO $db, int$id): array{
        $stmt = $db->prepare('
        SELECT productId, sellerID, brandID, categoryID, locationID, title, description, price, condition
        FROM PRODUCT 
        JOIN USERS ON PRODUCT.sellerID=USERS.userID
        JOIN BRAND USING (brandID)
        JOIN CATEGORY USING (categoryID)
        JOIN LOCATION USING (locationID)
        WHERE ProductId = ?
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
  }

?>