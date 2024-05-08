<?php declare(strict_types = 1);
?>

<?php function drawHead($name) {

    require_once('../database/connection.db.php');
    require_once('../database/product.class.php');

    $db = getDatabaseConnection();
    $favorites = Product::getFavorites($db, 3);
    $cart = Product::getCart($db, 1);
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="../assets/icons/revamp.jpg">
        <title>Revamp - <?php echo $name ?></title>
    </head>
    <body>
    <div id="profileDrawer" class="profile-drawer">
        <div class="drawer-header">
        <h1> Perfil </h1>
            <button class="abtn" onclick="closeProfileDrawer()">Fechar</button>
        </div>
        <div class="drawer-content">
            <p>Nome: <b>Francisco</b></p>
            <p>Email: <b>franciscoafonso04@outlook.pt</b></p>
        </div>
    </div>
    <div id="cartDrawer" class="profile-drawer">
        <div class="drawer-header">
        <h1> Carrinho </h1>
            <button class="abtn" onclick="closeCartDrawer()">Fechar</button>
        </div>
        <div class="drawer-content">
            <div class="flex-row">
                <?php drawProductCard($cart) ?>
            </div>
        </div>
    </div>
    <div id="favoritesDrawer" class="profile-drawer">
        <div class="drawer-header">
            <h1> Favoritos </h1>
            <button class="abtn" onclick="closeFavoritesDrawer()">Fechar</button>
        </div>
        <div class="drawer-content">
            <div class="flex-row">
                <?php drawProductCard($favorites) ?>
            </div>
        </div>
    </div>
    <div class="body-container"> 
<?php } ?>

<?php function drawHeader($showAuthButtons = false) { ?>
    <header>
        <div class="header-content">
            <h1><a href="home.php"> R E V A M P </a></h1>
            <div class="search-container">
                <form action="search.php" method="get">
                    <input type="text" name="query" placeholder="Search..." class="search-input">
                </form>
            </div>
            <div class="authentication-buttons">
                <?php if ($showAuthButtons): ?>
                    <a href="login.php"> <button class="abtn"> Iniciar Sessão </button></a>
                    <a href="register.php"> <button class="abtn"> Criar Conta </button></a>
                <?php else: ?>
                    <button onclick="openProfileDrawer()" class="abtn"> Perfil </button>
                    <button onclick="openCartDrawer()" class="abtn"> Carrinho </button>
                    <button onclick="openFavoritesDrawer()" class="abtn"> Favoritos </button>
                <?php endif; ?>
    
                <script src="script.js"></script>
            </div>
        </div>
    </header>
    <div class="categories">
        <ul>
            <li><a href="category.php?id=Telemóveis">Telemóveis</a></li>
            <li><a href="category.php?id=Tablets">Tablets</a></li>
            <li><a href="category.php?id=Capas e Películas">Capas e Películas</a></li>
            <li><a href="category.php?id=Carregadores e Cabos">Carregadores e cabos</a></li>
            <li><a href="category.php?id=Power Banks">Power Banks</a></li>
        
        </ul>
    </div>
<?php } ?>

<?php function drawFooter() { ?>
    </div> <!-- Fim do container do conteúdo principal -->
    <footer>
        <div class="footer-container">   
            <h3><a href="home.php"> R E V A M P © 2024 </a></h3>
        </div>
    </footer>
    <script>
    function openProfileDrawer() {
        document.getElementById('profileDrawer').classList.add('open');
    }

    function closeProfileDrawer() {
        document.getElementById('profileDrawer').classList.remove('open');
    }
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

