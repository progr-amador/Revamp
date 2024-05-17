<?php declare(strict_types = 1); ?>

<?php function drawReserved($reserverd) { ?>
    <main>
        <div class="item-list">
            <h2>Reservados</h2>
            <div class="flex-container">
                <div class="flex-row">
                <?php drawReservedCard($reserverd) ?>
                </div>
            </div>
        </div>
    </main>
<?php } ?>

<?php function drawReservedCard($products) {
    if(empty($products)) {echo '<p id="price">Ainda não tem produtos reservados para venda</p>';}
    foreach ($products as $product) { ?>
        <div class="small-flex-item">
            <a href="product.php?id=<?php echo $product['productID']; ?>">
                <div class="small-item-image">
                    <img src="<?php echo $product['photoURL']; ?>" alt="Image of <?php echo $product['title']; ?>">
                </div>
                <div class="small-item-details">
                    <h3 id="title"><?php echo $product['title']; ?></h3>
                    <div class="bottom-details-reserved">
                        <p id="price"><?php echo $product['price']; ?> €</p>
                        <form action="../actions/action_accept_sale.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $product['productID']; ?>">
                            <button  type="submit" title="Aceitar Venda" class="abtn"><i class="material-icons">check</i></button>
                        </form>
                        <form action="../actions/action_cancel_sale.php" method="get">
                        <input type="hidden" name="id" value="<?php echo $product['productID']; ?>">
                            <button type="submit" title="Cancelar Venda" class="abtn"><i class="material-icons">close</i></button>
                        </form>
                    </div>
                </div>
            </a>
        </div>
    <?php }
} ?>