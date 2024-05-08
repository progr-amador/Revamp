<?php declare(strict_types = 1); ?>

<?php function drawProduct($product) { ?>
    <main>
        <div class="product-container">
            <div class="product-image">
                <img src="<?php echo $product['photoURL']; ?>" alt="<?php echo $product['title']; ?>">
            </div>
            <div class="product-details">
                <h1><?php echo $product['title']; ?></h1>
                <p class="price">€<?php echo $product['price']; ?></p>
                <p class="user"><?php echo $product['seller']; ?></p>
                <p class="description"><?php echo $product['description']; ?></p>
                <p class="location">Localização: <?php echo $product['location']; ?></p>
                <div class="buttons">
                    <a href="shipping.php"><button class="abtn"> Compre agora </button></a>
                    <a href="message.php"><button class="abtn"> Envie mensagem </button></a>
                    <button class="abtn"> Adicionar ao carrinho </button>
                </div>
            </div>
        </div>
    </main>
<?php } ?>
