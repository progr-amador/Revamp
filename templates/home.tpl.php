<?php declare(strict_types = 1); ?>

<?php function drawHome($featured, $favorites, $loggedin = false) { ?>
    <main>
        <div class="featured">
            <h2>Featured</h2>
            <div class="flex-container">
                <div class="flex-row">
                <?php drawProductCard($featured) ?>
                </div>
            </div>
        </div>
        <div class="favorites">
            <h2>Favorites</h2>
            <div class="flex-container">
                <div class="flex-row">
                <?php drawProductCard($favorites) ?>
                </div>
            </div>
        </div>
    </main>
<?php } ?>


