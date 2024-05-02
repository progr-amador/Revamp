<?php declare(strict_types = 1); 

function getProductDetails() {
    // This function simulates fetching product details from a database
    return [
        'name' => 'iPhone 13, 128GB',
        'price' => '800.00',
        'description' => 'A few little scratches on the back.',
        'image' => '../temp/iphone.jpg',
        'location' => 'Lisboa'
    ];
}

function drawProduct() {
    $product = getProductDetails();
?>
    <main>
        <div class="product-container">
            <div class="product-image">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </div>
            <div class="product-details">
                <h1><?php echo $product['name']; ?></h1>
                <p class="price">€<?php echo $product['price']; ?></p>
                <p class="description"><?php echo $product['description']; ?></p>
                <p class="location">Location: <?php echo $product['location']; ?></p>
                <button class="buy-now">Buy Now</button>
            </div>
        </div>
    </main>
<?php 
}

drawProduct();
?>
