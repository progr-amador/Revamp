<?php declare(strict_types=1); ?>

<?php function drawShipping(array $districts, array $cart): void { ?>
    <main id="shipping">
        <h1>Checkout</h1> 
        <div class="flex-container">
            <div class="flex-row">
                <?php drawSmallProductCard($cart); ?>
            </div>
        </div>
        <section id="shipping-details">
            <form action="../actions/action_set_reserved.php" method="post">
                <fieldset>
                    <legend>Detalhes Pessoais</legend>
                    <label for="name">Nome
                        <input type="text" id="name" name="name" required>
                    </label>
                    <label for="nif">NIF
                        <input type="text" id="nif" name="nif" maxlength="9" required>
                    </label>
                    <label for="mobile">Telemóvel
                        <input type="tel" id="mobile" name="mobile" maxlength="13" required>
                    </label>
                </fieldset>

                <fieldset>
                    <legend>Detalhes de Endereço</legend>
                    <label id="regiao">
                        Distrito
                        <select name="district">
                            <option value="">&mdash;</option>
                            <?php foreach ($districts as $district): ?>
                                <option value="<?php echo htmlspecialchars($district['locationName'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($district['locationName'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label for="street">Rua
                        <input id="street" type="text" name="street" required>
                    </label>
                    <label for="door">Porta
                        <input id="door" type="text" name="door" required>
                    </label>
                    <label for="localidade">Localidade
                        <input id="localidade" type="text" name="localidade" required>
                    </label>
                    <label for="postal_code">Código postal
                        <input id="postal_code" type="text" name="postal_code" maxlength="9" required>
                    </label>
                </fieldset>

                <fieldset>
                    <legend>Método de Pagamento</legend>
                    <div class="radio-option">
                        <label>
                            <input type="radio" name="payment_method" value="card" data-toggle-value="card" required>   
                            <img src="../assets/icons/creditcard.png" alt="Credit Card Logo"> Cartão de crédito
                        </label>
                    </div>
                    <div class="radio-option">
                        <label>
                            <input type="radio" name="payment_method" value="paypal" data-toggle-value="paypal"> 
                            <img src="../assets/icons/paypal.png" alt="PayPal Logo"> PayPal
                        </label>
                    </div>
                    <div class="radio-option">
                        <label>
                            <input type="radio" name="payment_method" value="mbway" data-toggle-value="mbway">
                            <img src="../assets/icons/mbway.png" alt="MB WAY Logo"> MB Way
                        </label>
                    </div> 
                    <div data-toggle-group="card" style="display: none;">
                        <!-- Fields for credit card payment -->
                    </div>
                    <div data-toggle-group="paypal" style="display: none;">
                        <!-- Fields for PayPal payment -->
                    </div>
                    <div data-toggle-group="mbway" style="display: none;">
                        <!-- Fields for MB Way payment -->
                    </div>
                </fieldset>
                <button type="submit" class="abtn">Finalizar</button>
            </form>
        </section>
    </main>
<?php } ?>
