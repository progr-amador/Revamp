<?php declare(strict_types=1); ?>

<?php 
function drawReserved(array $reserved): void { 
    ?>
    <main>
        <div class="item-list">
            <h2>Reservados</h2>
            <div class="flex-container">
                <div class="flex-row">
                    <?php drawReservedCard($reserved); ?>
                </div>
            </div>
        </div>
    </main>
<?php 
}

function drawReservedCard(array $products): void {
    if (empty($products)) {
        echo '<p id="price">Ainda não tem produtos reservados para venda</p>';
    } else {
        foreach ($products as $product) { 
            ?>
            <div class="small-flex-item">
                <a href="product.php?id=<?php echo htmlspecialchars($product['productID'], ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="small-item-image">
                        <img src="<?php echo htmlspecialchars($product['photoURL'], ENT_QUOTES, 'UTF-8'); ?>" alt="Image of <?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    <div class="small-item-details">
                        <h3 id="title"><?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <div class="bottom-details-reserved">
                            <p id="price"><?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?> €</p>
                            <form action="../code/shipping_form.php" method="get">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['productID'], ENT_QUOTES, 'UTF-8'); ?>">
                                <button type="submit" title="Aceitar Venda" class="abtn"><i class="material-icons">description</i></button>
                            </form>
                            <form action="../actions/action_cancel_sale.php" method="get">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['productID'], ENT_QUOTES, 'UTF-8'); ?>">
                                <button type="submit" title="Cancelar Venda" class="abtn"><i class="material-icons">close</i></button>
                            </form>
                        </div>
                    </div>
                </a>
            </div>
            <?php 
        }
    }
}
?>
