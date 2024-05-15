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
                <p><strong>Vendido por: </strong> <a href="profile.php?id=<?php echo $product['sellerID']; ?>"><class="user"><?php echo $product['seller']; ?></></a>
                <p><strong>Categoria: </strong><a href="category.php?id=<?php echo $product['categoryName']; ?>"><class="user"><?php echo $product['categoryName']; ?></></a>
                <p><strong>Estado: </strong><class="condition"><?php echo $product['condition']; ?></>
                <p><strong>Descrição: </strong><class="description"><?php echo $product['description']; ?></>
                <p><strong>Localização: </strong><class="location"><?php echo $product['location']; ?></>
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <div class="buttons">
                        <?php if($_SESSION['user_id'] === $product['sellerID']){ ?>
                            <form action="../actions/action_remove_product.php" method="post">
                                <input type="hidden" name="productID" value="<?php echo $ID ?>">
                                <button title="Delete product" type="submit" class="abtn"> <i class="material-icons">delete</i> </button>
                            </form>
                        <?php } else if($_SESSION['admin']){ ?>
                            <form action="shipping.php" method="get">
                                <button title="Buy now" type="submit" class="abtn"><i class="material-icons">shopping_bag</i></button>
                            </form>
                            <form action="message.php" method="get">
                                <button title="Message Seller" type="submit" class="abtn"><i class="material-icons">chat</i></button>
                            </form>

                            <form action="../actions/action_cart.php" method="post">
                                <input type="hidden" name="productID" value="<?php echo $ID ?>">
                                <button title="Add to cart" type="submit" class="abtn"> <i class="material-icons">add_shopping_cart</i> </button>
                            </form>
                            <form action="../actions/action_favorite.php" method="post">
                                <input type="hidden" name="productID" value="<?php echo $ID ?>">
                                <button title="Add to favorites" type="submit" class="abtn"> <i class="material-icons">favorite</i> </button>
                            </form>
                            <form action="../actions/action_remove_product.php" method="post">
                                <input type="hidden" name="productID" value="<?php echo $ID ?>">
                                <button title="Delete product" type="submit" class="abtn"> <i class="material-icons">delete</i> </button>
                            </form>
                        <?php } else { ?>
                            <a href="shipping.php"><button title="Buy now" class="abtn"> <i class="material-icons">shopping_bag</i> </button></a>
                            <a href="message.php"><button title="Message Seller" class="abtn"><i class="material-icons">chat</i></button></a>
                            <form action="../actions/action_cart.php" method="post">
                                <input type="hidden" name="productID" value="<?php echo $ID ?>">
                                <button title="Add to cart" type="submit" class="abtn"> <i class="material-icons">add_shopping_cart</i> </button>
                            </form>
                            <form action="../actions/action_favorite.php" method="post">
                                <input type="hidden" name="productID" value="<?php echo $ID ?>">
                                <button title="Add to favorites" type="submit" class="abtn"> <i class="material-icons">favorite</i> </button>
                            </form>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
<?php } ?>
