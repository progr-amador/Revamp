<?php declare(strict_types = 1); ?>

<?php function drawHome($featured) { ?>
    <main>
        <div class="item-list">
            <h2>Em Destaque</h2>
            <div class="flex-container">
                <div class="flex-row">
                <?php drawProductCard($featured) ?>
                </div>
            </div>
        </div>
    </main>
<?php } ?>


