<?php declare(strict_types = 1); ?>

<?php   
    function getProductDetails() {
        // This function simulates fetching product details from a database
        return [
            'name' => 'iPhone 13, 128GB',
            'price' => '800.00',
            'description' => 
            "Looking for an affordable upgrade to your smartphone experience? Look no further! Presenting a gently used iPhone 13 with 128GB of storage, perfect for storing all your memories, apps, and more. While it may have a few scratches on the back, its performance and functionality remain top-notch. This sleek device offers the iconic iPhone experience, with a stunning display, powerful camera system, and seamless iOS integration. Whether you're capturing cherished moments or staying connected on the go, this iPhone 13 is ready to enhance your digital life. Don't miss out on this opportunity to own a premium device at a fraction of the cost. Grab it now and embark on a new journey of convenience and style!",
            'image' => '../temp/iphone.jpg',
            'location' => 'Lisboa',
            'seller' => 'francisco',
        ];
    }
?>
<?php function drawProduct() {
        $product = getProductDetails(); ?>
    <main>
        <div class="product-container">
            <div class="product-image">
                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
            </div>
            <div class="product-details">
                <h1><?php echo $product['name']; ?></h1>
                <p class="price">€<?php echo $product['price']; ?></p>
                <p class="user"><?php echo $product['seller']; ?></p>
                <p class="description"><?php echo $product['description']; ?></p>
                <p class="location">Location: <?php echo $product['location']; ?></p>
                <div class="buttons">
                    <button class="buy-now">Buy Now</button>
                    <button class="message">Message Seller</button>
                </div>
            </div>
        </div>
    </main>
<?php } ?>
