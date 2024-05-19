<?php
    declare(strict_types=1);

    session_start();

    require_once('../database/connection.db.php');
    require_once('../database/product.class.php');
    require_once('../csrf_token.php');
    
    $db = getDatabaseConnection();

    $ID = $_GET['id'];

    $product = Product::getReservedProduct($db, intval($ID));

    $name = $product['name'];
    $district = $product['district'];
    $street = $product['street'];
    $door = $product['door'];
    $localidade = $product['localidade'];
    $postal_code = $product['postal_code'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Revamp - Formulário de envio</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="icon" href="../assets/icons/revamp.jpg">
    </head>
    <body>
        <div class="body-container" id="shipping-form">
            <main>
                <h2>Formulário de envio</h2>

                <label for="name">Nome</label>
                <textarea id="name" name="name" wrap="soft" readonly><?php echo $name ?></textarea>

                <label for="district">Distrito</label>
                <textarea id="district" name="district" readonly><?php echo $district ?></textarea>

                <label for="street">Rua</label>
                <textarea id="street" name="street" readonly><?php echo $street ?></textarea>

                <label for="door">Porta</label>
                <textarea id="door" name="door" readonly><?php echo $door ?></textarea>

                <label for="localidade">Localidade</label>
                <textarea id="localidade" name="localidade" readonly><?php echo $localidade ?></textarea>

                <label for="postal_code">Código postal</label>
                <textarea id="postal_code" name="postal_code" readonly><?php echo $postal_code ?></textarea>

                <form action="../actions/action_remove_product.php" method="post">
                    <input type="hidden" name="whereTo" value="reserved">
                    <button type="submit" value="<?php echo $ID ?>" name="productID" title="Confirmar Venda" class="abtn"><i class="material-icons">check</i></button>
                    <button name="print" title="Imprimir" class="abtn" onclick="window.print();return false;"><i class="material-icons">print</i></button>
                </form>
            </main>
        </div>
    </body>
</html>