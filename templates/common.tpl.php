<?php declare(strict_types = 1); ?>

<?php function drawHead(string $name) {
    require_once('../database/connection.db.php');
    require_once('../database/baskets.class.php');

    $db = getDatabaseConnection();
    $favorites = [];
    $cart = [];
    $cartTotal = 0.0;

    if ($_SESSION['user_id'] != null) {
        $favorites = Baskets::getFavorites($db, $_SESSION['user_id']);
        $cart = Baskets::getCart($db, $_SESSION['user_id']);
        $cartTotal = Baskets::getCartTotalPrice($db, $_SESSION['user_id']);
    }
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Revamp - <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="../style/responsive.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" href="../assets/icons/revamp.jpg">
        <script src="../javascript/script.js" defer></script>
    </head>
    <body>
    <div id="cartDrawer" class="header-drawer">
        <div class="drawer-header">
        <h1> Carrinho </h1>
            <a href="shipping.php"><button class="abtn" title="Checkout" onclick="closeCartDrawer()"><i class="material-icons">shopping_cart_checkout</i></button></a>
            <a href="../actions/action_empty_cart.php"><button class="abtn" title="Esvaziar"><i class="material-icons">remove_shopping_cart</i></button></a>
            <button class="abtn" title="Fechar" onclick="closeCartDrawer()"><i class="material-icons">close</i></button>
        </div>
        <div class="drawer-content">
            <div class="flex-row">
                <h3><strong>Preço Total:</strong> <?php echo htmlspecialchars((string)$cartTotal, ENT_QUOTES, 'UTF-8'); ?> € </h3>
                <?php drawSmallProductCard($cart) ?>
            </div>
            
        </div>
        
    </div>
    <div id="favoritesDrawer" class="header-drawer">
        <div class="drawer-header">
            <h1> Favoritos </h1>  
            <a href="../actions/action_empty_favorites.php"><button class="abtn" title="Esvaziar"><i class="material-icons">heart_broken</i></button></a>
            <button class="abtn" title="Fechar" onclick="closeFavoritesDrawer()"><i class="material-icons">close</i></button>
        </div>
        <div class="drawer-content">
            <div class="flex-row">
                <?php drawSmallProductCard($favorites) ?>
            </div>
        </div>
        </div>
    <div class="body-container"> 
<?php } ?>

<?php function drawHeader(string $value = "") { 
    require_once('../database/connection.db.php');
    require_once('../database/category.class.php');

    $db = getDatabaseConnection();
    $categories = Category::getCategories($db);


?>
    <header>
        <div class="header-content">
            <h1><a href="home.php"> R E V A M P </a></h1>
            <div class="search-container">
                <form action="search.php"  method="get">
                <input id="searchproduct" type="text" name="query" placeholder="Search..." class="search-input" autocomplete="off" value="<?php echo htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); ?>">
                </form>
            </div>
            <div class="authentication-buttons">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="profile.php?id=<?php echo htmlspecialchars((string)$_SESSION['user_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <button class="abtn" title="Perfil"><i class="material-icons">account_circle</i></button></a>
                    <button onclick="openCartDrawer()" title="Carrinho" class="abtn"> <i class="material-icons">shopping_cart</i> </button>
                    <button onclick="openFavoritesDrawer()" title="Favoritos" class="abtn"> <i class="material-icons">favorite</i> </button>
                    <a href="new_product.php"> <button class="abtn" title="Vender"> <i class="material-icons">sell</i> </button></a>
                <?php else: ?>
                    <a href="login.php"> <button class="abtn" title="Iniciar Sessão" > <i class="material-icons">login</i> </button></a>
                    <a href="register.php"> <button class="abtn" title="Registar"> <i class="material-icons">person_add</i> </button></a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <div class="categories">
        <ul>
            <?php drawCategories($categories) ?>
        </ul>
    </div>
<?php } ?>

<?php function drawFooter() { ?>
    </div> 
    <footer>
        <div class="footer-container">   
            <h3><a href="home.php"> R E V A M P © 2024 </a></h3>
        </div>
    </footer>
    <script>
    function openCartDrawer() {
        document.getElementById('cartDrawer').classList.add('open');
    }

    function closeCartDrawer() {
        document.getElementById('cartDrawer').classList.remove('open');
    }
    function openFavoritesDrawer() {
        document.getElementById('favoritesDrawer').classList.add('open');
    }

    function closeFavoritesDrawer() {
        document.getElementById('favoritesDrawer').classList.remove('open');
    }
    </script>
</body>
</html>
<?php } ?>

<?php function drawProductCard(array $products) {
    if(!isMobile()){
        foreach ($products as $product) { ?>
            <div class="flex-item">
                <a href="product.php?id=<?php echo htmlspecialchars((string)$product['productID'], ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="item-image">
                        <img src="<?php echo htmlspecialchars($product['photoURL'], ENT_QUOTES, 'UTF-8'); ?>" alt="Image for <?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    <div class="item-details">                   
                        <h3 id="title"><?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p id="price"><?php echo htmlspecialchars((string)$product['price'], ENT_QUOTES, 'UTF-8'); ?> €</p>
                        <p id="location"><?php echo htmlspecialchars($product['location'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </a>
            </div>
        <?php } 
    } else {
        foreach ($products as $product) { ?>
            <div class="small-flex-item">
                <a href="product.php?id=<?php echo htmlspecialchars((string)$product['productID'], ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="small-item-image">
                        <img src="<?php echo htmlspecialchars($product['photoURL'], ENT_QUOTES, 'UTF-8'); ?>" alt="Image of <?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    <div class="small-item-details">
                        <h3 id="title"><?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p id="price"><?php echo htmlspecialchars((string)$product['price'], ENT_QUOTES, 'UTF-8'); ?> €</p>
                    </div>
                </a>
            </div>
        <?php }
    }
} ?>

<?php function drawSmallProductCard(array $products) {
    foreach ($products as $product) { ?>
        <div class="small-flex-item">
            <a href="product.php?id=<?php echo htmlspecialchars((string)$product['productID'], ENT_QUOTES, 'UTF-8'); ?>">
                <div class="small-item-image">
                    <img src="<?php echo htmlspecialchars($product['photoURL'], ENT_QUOTES, 'UTF-8'); ?>" alt="Image of <?php echo $product['title']; ?>">
                </div>
                <div class="small-item-details">
                    <h3 id="title"><?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p id="price"><?php echo htmlspecialchars((string)$product['price'], ENT_QUOTES, 'UTF-8'); ?> €</p>
                </div>
            </a>
        </div>
    <?php }
} ?>


<?php function drawCategories(array $categories) {
    foreach ($categories as $category) { ?>
        <li><a href="category.php?id=<?php echo htmlspecialchars(strval($category['categoryID']), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($category['categoryName'], ENT_QUOTES, 'UTF-8'); ?></a></li>
    <?php }
} ?>

<?php function isMobile() {
    return (bool) preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
} ?>

