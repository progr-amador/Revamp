<?php
    declare(strict_types=1);

    session_start();

    require_once('../database/connection.db.php');
    require_once('../database/product.class.php');

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
                <input type="text" id="name" name="name" readonly value="<?php echo $name ?>">

                <label for="district">Distrito</label>
                <input type="text" id="district" name="district" readonly value="<?php echo $district ?>">

                <label for="street">Rua</label>
                <input type="text" id="street" name="street" readonly value="<?php echo $street ?>">

                <label for="door">Porta</label>
                <input type="text" id="door" name="door" readonly value="<?php echo $door ?>">

                <label for="localidade">Localidade</label>
                <input type="text" id="localidade" name="localidade" readonly value="<?php echo $localidade ?>">

                <label for="postal_code">Código postal</label>
                <input type="text" id="postal_code" name="postal_code" readonly value="<?php echo $postal_code ?>">

                <form action="../actions/action_remove_product.php" method="get">
                    <button type="submit" value="<?php echo $ID ?>" name="productID" title="Confirmar Venda" class="abtn"><i class="material-icons">check</i></button>
                    <button name="print" title="Imprimir" class="abtn" onclick="window.print();return false;"><i class="material-icons">print</i></button>
                </form>
            </main>
        </div>
    </body>
</html>