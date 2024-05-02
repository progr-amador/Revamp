<?php declare(strict_types = 1); ?>

<?php function drawHead($name) { ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="../docs/revamp.jpg">
        <title>Revamp - <?php echo $name; ?></title>
    </head>
    <body>
    <div id="profileDrawer" class="profile-drawer">
        <div class="drawer-header">
            <button class="abtn" onclick="closeDrawer()">Fechar</button>
        </div>
        <div class="drawer-content">
            <p>Nome: <b>Francisco</b></p>
            <p>Email: <b>franciscoafonso04@outlook.pt</b></p>
        </div>
    </div>
    <div class="body-container"> <!-- Início do container flexível -->
<?php } ?>

<?php function drawHeader($showAuthButtons = false) { ?>
    <header>
        <div class="header-content">
            <h1><a href="home.php"> R E V A M P </a></h1>
            <div class="search-container">
                <form action="search.php" method="get">
                    <input type="text" placeholder="Search..." class="search-input">
                </form>
            </div>
            <div class="authentication-buttons">
                <?php if ($showAuthButtons): ?>
                    <a href="login.php"> <button class="abtn"> Login </button></a>
                    <a href="register.php"> <button class="abtn"> Sign Up</button></a>
                <?php else: ?>
                    <button onclick="openDrawer()" class="abtn"> Profile </button>
                <?php endif; ?>
    
                <script src="script.js"></script>
            </div>
        </div>
    </header>
    <div class="categories">
        <ul>
            <li><a href="#">Telemóveis</a></li>
            <li><a href="#">Tablets</a></li>
            <li><a href="#">Capas e Películas</a></li>
            <li><a href="#">Carregadores e cabos</a></li>
            <li><a href="#">Power Banks</a></li>
        
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
    function openDrawer() {
        document.getElementById('profileDrawer').classList.add('open');
    }

    function closeDrawer() {
        document.getElementById('profileDrawer').classList.remove('open');
    }
    </script>
</body>
</html>
<?php } ?>

