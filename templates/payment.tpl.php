<?php declare(strict_types = 1); ?>


<?php function drawPaypal() { ?>
    <main id="payment">
        <h1>Pagamento com PayPal</h1>
        <form action="../actions/action_empty_cart.php" method="post">
            <label for="email">Email
                <input type="email" id="email" name="email" required>
            </label>
            <label for="nif">Password
                <input type="password" id="password" name="password" required>
            </label>
            <button type="submit" class = "abtn" >Finalizar</button>
        </form>
    </main>
<?php } ?>

<?php function drawCredit() { ?>
    <main id="payment">
        <h1>Pagamento com Cartão de Crédito</h1>
        <form action="../actions/action_empty_cart.php" method="post">
            <label for="name">Nome do Titular
                <input type="text" id="name" name="name" required>
            </label>
            <label for="nif">Número do Cartão
                <input type="number" id="cardID" name="cardID" max="9999999999999999" required>
            </label>
            <label for="nif">Validade
                <input type="month" id="date" name="date" required>
            </label>
            <label for="nif">CVV
                <input type="number" id="cvv" name="cvv" max="999" required>
            </label>
            <button type="submit" class = "abtn" >Finalizar</button>
        </form>
    </main>
<?php } ?>

<?php function drawMB() { ?>
    <main id="payment">
        <h1>Pagamento com MB Way</h1>
        <form action="../actions/action_empty_cart.php" method="post">
            <label for="mobile">Número de Telemóvel
                <input type="tel" id="mobile" name="mobile" required>
            </label>
            <button type="submit" class = "abtn" >Finalizar</button>
        </form>
    </main>
<?php } ?>
