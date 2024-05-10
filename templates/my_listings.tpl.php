<?php declare(strict_types = 1); ?>

<?php function drawMyListings($listings) { ?>
    <main>
        <div class="item-list">
            <h2>Os Meus Produtos</h2>
            <div class="flex-container">
                <div class="flex-row">
                    <?php drawProductCard($listings) ?>
                </div>
            </div>
        </div>
    </main>
<?php } ?>