<?php declare(strict_types = 1); ?>

<?php function drawHead($name) {
    require_once('../database/connection.db.php');
    require_once('../database/product.class.php');

    $db = getDatabaseConnection();
    $favorites = Product::getFavorites($db, $_SESSION['user_id']);
    $cart = Product::getCart($db, $_SESSION['user_id']);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="../assets/icons/revamp.jpg">
        <title>Revamp - <?php echo $name; ?></title>
    </head>
    <body>
    <div id="cartDrawer" class="header-drawer">
        <div class="drawer-header">
        <h1> Carrinho </h1>
            
            <button class="abtn" onclick="closeCartDrawer()">Fechar</button>
        </div>
        <div class="drawer-content">
            <div class="flex-row">
                <?php drawSmallProductCard($cart) ?>
            </div>
            <div class="cart-buttons">
                <a href="shipping.php"><button class="abtn2" onclick="closeCartDrawer()">Comprar</button></a>
    
                <a href="../actions/action_empty_cart.php"><button class="abtn2">Esvaziar</button></a>
            </div>
        </div>
        
    </div>
    <div id="favoritesDrawer" class="header-drawer">
        <div class="drawer-header">
            <h1> Favoritos </h1>
            
            <button class="abtn" onclick="closeFavoritesDrawer()">Fechar</button>
        </div>
        <div class="drawer-content">
            <div class="flex-row">
                <?php drawSmallProductCard($cart) ?>
            </div>
            <div class="cart-buttons">
                
    
                <a href="../actions/action_empty_cart.php"><button class="abtn2">Esvaziar</button></a>
            </div>
        </div>
        </div>
    <div class="body-container"> 
<?php } ?>

<?php function drawHeader() { 
    require_once('../database/connection.db.php');
    require_once('../database/category.class.php');

    $db = getDatabaseConnection();
    $categories = Category::getCategories($db);


?>
    <header>
        <div class="header-content">
            <h1><a href="home.php"> R E V A M P </a></h1>
            <div class="search-container">
                <form action="search.php" method="get">
                    <input type="text" name="query" placeholder="Search..." class="search-input">
                </form>
            </div>
            <div class="authentication-buttons">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="profile.php?id=<?php echo $_SESSION['user_id']; ?>"><button class="abtn" >Perfil</button></a>
                    <button onclick="openCartDrawer()" class="abtn"> Carrinho </button>
                    <button onclick="openFavoritesDrawer()" class="abtn"> Favoritos </button>
                    <a href="new_product.php"> <button class="abtn"> Vender </button></a>
                    <?php if ($_SESSION['admin']): ?>
                        <a href="control_panel.php"> <button class="abtn"> Painel de Controlo </button></a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="login.php"> <button class="abtn"> Iniciar Sessão </button></a>
                    <a href="register.php"> <button class="abtn"> Criar Conta </button></a>
                <?php endif; ?>
    
                <script src="script.js"></script>
            </div>
        </div>
    </header>
    <div class="categories">
        <ul>
            <?php drawcategories($categories) ?>
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

<?php function drawProductCard($products) {
    foreach ($products as $product) { ?>
        <div class="flex-item">
            <a href="product.php?id=<?php echo $product['productID']; ?>">
                <div class="item-image">
                    <img src="<?php echo $product['photoURL']; ?>" alt="Image for <?php echo $product['title']; ?>">
                </div>
                <div class="item-details">                   
                    <h3 id="title"><?php echo $product['title']; ?></h3>
                    <p id="price"><?php echo $product['price']; ?> €</p>
                    <p id="location"><?php echo $product['location']; ?></p>
                </div>
            </a>
        </div>
    <?php } 
} ?>

<?php function drawSmallProductCard($products) {
    foreach ($products as $product) { ?>
        <div class="small-flex-item">
            <a href="product.php?id=<?php echo $product['productID']; ?>">
                <div class="small-item-image">
                    <img src="<?php echo $product['photoURL']; ?>" alt="Image of <?php echo $product['title']; ?>">
                </div>
                <div class="small-item-details">
                    <h3 id="title"><?php echo $product['title']; ?></h3>
                    <p id="price"><?php echo $product['price']; ?> €</p>
                </div>
            </a>
        </div>
    <?php }
} ?>


<?php function drawcategories($categories) {
    foreach ($categories as $category) { ?>
        <li><a href="category.php?id=<?php echo $category['categoryName']; ?>"><?php echo $category['categoryName']; ?></a></li>
    <?php }
} ?>

