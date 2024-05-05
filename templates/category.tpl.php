<?php declare(strict_types = 1); ?>

<?php function drawCategory($category, $products) { ?>
    <main>
        <div class="featured">
            <h2><?php echo $category; ?></h2>
            <div class="flex-container">
                <div class="flex-row">
                    <?php drawProductCard($products) ?>
                </div>
            </div>
        </div>
    </main>
<?php } ?>
