<?php declare(strict_types=1); ?>

<?php
function drawProduct(array $product, int $ID, array $photos): void {
    $errorMessage = '';
    if (isset($_SESSION['error_message'])) {
        $errorMessage = '<p>' . htmlspecialchars($_SESSION['error_message'], ENT_QUOTES, 'UTF-8') . '</p>';
        unset($_SESSION['error_message']);
    }
    ?>
    <main>
        <div class="product-container">
            <div class="product-image">
                <?php if (!empty($photos)) { ?>
                    <img id="main-photo" src="<?php echo htmlspecialchars($photos[0]['photoURL'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?>">
                <?php } else { ?>
                    <img id="main-photo" src="default-photo-url.jpg" alt="Default Image">
                <?php } ?>
                <div class="photo-navigation">
                    <?php foreach ($photos as $index => $photo) { ?>
                        <img src="<?php echo htmlspecialchars($photo['photoURL'], ENT_QUOTES, 'UTF-8'); ?>" alt="Photo <?php echo $index + 1; ?>" class="thumbnail" onclick="changePhoto('<?php echo htmlspecialchars($photo['photoURL'], ENT_QUOTES, 'UTF-8'); ?>')">
                    <?php } ?>
                </div>
            </div>
            <div class="product-details">
                <div class="top-zone">
                    <h1><?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
                    <p class="price"><?php echo htmlspecialchars((string)$product['price'], ENT_QUOTES, 'UTF-8'); ?>€</p>
                    <p><strong>Descrição: </strong><span class="description"><?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></span></p>
                </div>
                
                <div class="bottom-zone">
                    <p><strong>Vendido por: </strong> <a href="profile.php?id=<?php echo htmlspecialchars((string)$product['sellerID'], ENT_QUOTES, 'UTF-8'); ?>" class="user"><?php echo htmlspecialchars($product['seller'], ENT_QUOTES, 'UTF-8'); ?></a></p>
                    <p><strong>Categoria: </strong><a href="category.php?id=<?php echo htmlspecialchars((string)$product['categoryID'], ENT_QUOTES, 'UTF-8'); ?>" class="user"><?php echo htmlspecialchars($product['categoryName'], ENT_QUOTES, 'UTF-8'); ?></a></p>
                    <p><strong>Estado: </strong><span class="condition"><?php echo htmlspecialchars($product['condition'], ENT_QUOTES, 'UTF-8'); ?></span></p>
                    <p><strong>Localização: </strong><span class="location"><?php echo htmlspecialchars($product['location'], ENT_QUOTES, 'UTF-8'); ?></span></p>
                
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <div class="buttons">
                            <?php if($_SESSION['user_id'] === $product['sellerID']) { ?>
                                <form action="../actions/action_remove_product.php" method="post">
                                    <input type="hidden" name="whereTo" value="home">
                                    <input type="hidden" name="productID" value="<?php echo htmlspecialchars((string)$ID, ENT_QUOTES, 'UTF-8'); ?>">
                                    <button title="Delete product" type="submit" class="abtn"> <i class="material-icons">delete</i> </button>
                                </form>
                            <?php } else if($_SESSION['admin']) { ?>
                                <form action="../actions/action_add_chat.php" method="get">
                                    <input type="hidden" name="buyerID" value="<?php echo htmlspecialchars((string)$_SESSION['user_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" name="sellerID" value="<?php echo htmlspecialchars((string)$product['sellerID'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" name="productID" value="<?php echo htmlspecialchars((string)$product['productID'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button title="Message Seller" type="submit" class="abtn"><i class="material-icons">chat</i></button>
                                </form>
                                <form action="../actions/action_cart.php" method="post">
                                    <input type="hidden" name="productID" value="<?php echo htmlspecialchars((string)$ID, ENT_QUOTES, 'UTF-8'); ?>">
                                    <button title="Add to cart" type="submit" class="abtn"> <i class="material-icons">add_shopping_cart</i> </button>
                                </form>
                                <form action="../actions/action_favorite.php" method="post">
                                    <input type="hidden" name="productID" value="<?php echo htmlspecialchars((string)$ID, ENT_QUOTES, 'UTF-8'); ?>">
                                    <button title="Add to favorites" type="submit" class="abtn"> <i class="material-icons">favorite</i> </button>
                                </form>
                                <form action="../actions/action_remove_product.php" method="post">
                                    <input type="hidden" name="whereTo" value="reserved">
                                    <input type="hidden" name="productID" value="<?php echo htmlspecialchars((string)$ID, ENT_QUOTES, 'UTF-8'); ?>">
                                    <button title="Delete product" type="submit" class="abtn"> <i class="material-icons">delete</i> </button>
                                </form>
                            <?php } else { ?>
                                <form action="../actions/action_add_chat.php" method="get">
                                    <input type="hidden" name="buyerID" value="<?php echo htmlspecialchars((string)$_SESSION['user_id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" name="sellerID" value="<?php echo htmlspecialchars((string)$product['sellerID'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <input type="hidden" name="productID" value="<?php echo htmlspecialchars((string)$product['productID'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button title="Message Seller" type="submit" class="abtn"><i class="material-icons">chat</i></button>
                                </form>
                                <form action="../actions/action_cart.php" method="post">
                                    <input type="hidden" name="productID" value="<?php echo htmlspecialchars((string)$ID, ENT_QUOTES, 'UTF-8'); ?>">
                                    <button title="Add to cart" type="submit" class="abtn"> <i class="material-icons">add_shopping_cart</i> </button>
                                </form>
                                <form action="../actions/action_favorite.php" method="post">
                                    <input type="hidden" name="productID" value="<?php echo htmlspecialchars((string)$ID, ENT_QUOTES, 'UTF-8'); ?>">
                                    <button title="Add to favorites" type="submit" class="abtn"> <i class="material-icons">favorite</i> </button>
                                </form>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>
    <script>
        function changePhoto(url) {
            document.getElementById('main-photo').src = url;
        }
    </script>
<?php } ?>
