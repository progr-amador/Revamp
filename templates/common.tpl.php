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
<?php } ?>

<?php function drawHeader() { ?>
    <header>
        <div class="header-content">
            <h1>R E V A M P</h1>
            <div class="search-container">
                <form action="search" method="get">
                    <input type="text" placeholder="Search..." class="search-input">
                </form>
            </div>
            <div class="authentication-buttons">
                <a href="login.php"> <button class="abtn"> Login </button></a>
                <a href="register.php"> <button class="abtn"> Sign Up</button></a>
            </div>
        </div>
    </header>
    <div class="categories">
        <ul>
            <li><a href="#">Veículos</a></li>
            <li><a href="#">Tecnologia</a></li>
            <li><a href="#">Vestuário</a></li>
            <li><a href="#">Calçado</a></li>
            <li><a href="#">Filmes, Livros e Música</a></li>
            <li><a href="#">Saúde e Beleza</a></li>
            <li><a href="#">Serviços</a></li>

        </ul>
    </div>
<?php } ?>

<?php function drawFooter() { ?>
    <footer>
        <div class="footer-container">   
            <h3>R E V A M P © 2024</h3>
        </div>
    </footer>
</body>
</html>
<?php } ?>