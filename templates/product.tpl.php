<?php declare(strict_types = 1); ?>

<?php function drawProduct($product, $ID, $photos) { ?>
    <main>
        <div class="product-container">
            <div class="product-image">
                <?php if (!empty($photos)) { ?>
                    <img id="main-photo" src="<?php echo $photos[0]['photoURL']; ?>" alt="<?php echo $product['title']; ?>">
                <?php } else { ?>
                    <img id="main-photo" src="default-photo-url.jpg" alt="Default Image">
                <?php } ?>
                <div class="photo-navigation">
                    <?php foreach ($photos as $index => $photo) { ?>
                        <img src="<?php echo $photo['photoURL']; ?>" alt="Photo <?php echo $index + 1; ?>" class="thumbnail" onclick="changePhoto('<?php echo $photo['photoURL']; ?>')">
                    <?php } ?>
                </div>
            </div>
            <div class="product-details">
                <h1><?php echo $product['title']; ?></h1>
                <p class="price"><?php echo $product['price']; ?>€</p>
                <p><strong>Vendido por: </strong> <a href="profile.php?id=<?php echo $product['sellerID']; ?>" class="user"><?php echo $product['seller']; ?></a></p>
                <p><strong>Categoria: </strong><a href="category.php?id=<?php echo $product['categoryID']; ?>" class="user"><?php echo $product['categoryName']; ?></a></p>
                <p><strong>Estado: </strong><span class="condition"><?php echo $product['condition']; ?></span></p>
                <p><strong>Descrição: </strong><span class="description"><?php echo $product['description']; ?></span></p>
                <p><strong>Localização: </strong><span class="location"><?php echo $product['location']; ?></span></p>
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <div class="buttons">
                        <?php if($_SESSION['user_id'] === $product['sellerID']) { ?>
                            <form action="../actions/action_remove_product.php" method="post">
                                <input type="hidden" name="productID" value="<?php echo $ID ?>">
                                <button title="Delete product" type="submit" class="abtn"> <i class="material-icons">delete</i> </button>
                            </form>
                        <?php } else if($_SESSION['admin']) { ?>
                            <form action="shipping.php" method="get">
                                <button title="Buy now" type="submit" class="abtn"><i class="material-icons">shopping_bag</i></button>
                            </form>
                            <form action="../actions/action_add_chat.php" method="get">
                                <input type="hidden" name="buyerID" value="<?php echo $_SESSION['user_id'] ?>">
                                <input type="hidden" name="sellerID" value="<?php echo $product['sellerID'] ?>">
                                <input type="hidden" name="productID" value="<?php echo $product['productID'] ?>">
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
                            <form action="shipping.php" method="post">
                                <button title="Buy now" class="abtn"> <i class="material-icons">shopping_bag</i> </button>
                            </form>
                            <form action="../actions/action_add_chat.php" method="get">
                                <input type="hidden" name="buyerID" value="<?php echo $_SESSION['user_id'] ?>">
                                <input type="hidden" name="sellerID" value="<?php echo $product['sellerID'] ?>">
                                <input type="hidden" name="productID" value="<?php echo $product['productID'] ?>">
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
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
    <script>
        function changePhoto(url) {
            document.getElementById('main-photo').src = url;
        }
    </script>
<?php } ?>
