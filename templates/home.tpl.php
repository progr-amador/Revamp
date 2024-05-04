<?php declare(strict_types = 1); ?>

<?php function drawHome($products) { ?>
    <main>
        <div class="featured">
            <h2>Featured</h2>
            <div class="flex-container">
                <div class="flex-row">
                <?php foreach ($products as $product) { ?>
                    <div class="flex-item">
                        <div class="item-image">
                            <img src="../temp/iphone.jpg" alt="<?php echo $product['title']; ?>">
                        </div>
                        <div class="item-details">
                            <h3><?php echo $product['title']; ?></h3>
                            <p><?php echo $product['price']; ?></p>
                        </div>
                    </div>
                <?php } ?>
                    <!-- Repita para os outros itens -->
                </div>
            </div>
        </div>
    </main>
<?php } ?>


