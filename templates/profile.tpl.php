<?php declare(strict_types = 1); ?>

<?php function drawProfile($listings) {

require_once('../database/connection.db.php');
require_once('../database/product.class.php');

$db = getDatabaseConnection();
$favorites = Product::getFavorites($db, $_SESSION['user_id']);
$cart = Product::getCart($db, $_SESSION['user_id']);
?>
 <!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <img src="../assets/icons/person.jpg" alt="Foto de perfil" height=200px  class="profile-photo">
            <h1><?php echo $_SESSION['user_name'];?></h1>
        </div>
        <div class="profile-info">
            <p><strong>Email:</strong> <?php echo $_SESSION['email'];?></p>
            <p><strong>Telefone:</strong> <?php echo $_SESSION['phoneNumber'];?></p>
            <p><strong>Juntou-se em:</strong> <?php echo $_SESSION['creationDate'];?> </p>
        </div>
        <form action="../actions/action_logout.php" method="post">
                <button type="submit" class="abtn"> Terminar Sessão </button>
            </form>
    </div>
    <div class="item-list">
            <h2>Os Meus Produtos</h2>
            <div class="flex-container">
                <div class="flex-row">
                    <?php drawProductCard($listings) ?>
                </div>
            </div>
    </div>
</body>
</html>

<?php } ?>
