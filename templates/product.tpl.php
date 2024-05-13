<?php declare(strict_types = 1); ?>

<?php function drawProduct($product, $ID) { ?>
    <main>
        <div class="product-container">
            <div class="product-image">
                <img src="<?php echo $product['photoURL']; ?>" alt="<?php echo $product['title']; ?>">
            </div>
            <div class="product-details">
                <h1><?php echo $product['title']; ?></h1>
                <p class="price"><?php echo $product['price']; ?>€</p>
                <a href="profile.php?id=<?php echo $product['sellerID']; ?>"><p class="user"><?php echo $product['seller']; ?></p></a>
                <a href="category.php?id=<?php echo $product['categoryName']; ?>"><p class="user"><?php echo $product['categoryName']; ?></p></a>
                <p class="description"><?php echo $product['description']; ?></p>
                <p class="location">Localização: <?php echo $product['location']; ?></p>
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <div class="buttons">
                        <?php if($_SESSION['user_id'] === $product['sellerID']): ?>
                            <form action="../actions/action_remove_product.php" method="post">
                                <input type="hidden" name="productID" value="<?php echo $ID ?>">
                                <button type="submit" class="abtn"> Remover </button>
                            </form>
                        <?php else: ?>
                            <a href="shipping.php"><button class="abtn"> Compre agora </button></a>
                            <a href="message.php"><button class="abtn"> Envie mensagem </button></a>
                            <form action="../actions/action_cart.php" method="post">
                                <input type="hidden" name="productID" value="<?php echo $ID ?>">
                                <button type="submit" class="abtn"> Adicionar ao Carrinho </button>
                            </form>
                            <form action="../actions/action_favorite.php" method="post">
                                <input type="hidden" name="productID" value="<?php echo $ID ?>">
                                <button type="submit" class="abtn"> Adicionar aos Favoritos </button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
<?php } ?>
