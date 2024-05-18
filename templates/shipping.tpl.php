<?php declare(strict_types = 1); ?>

<?php function drawShipping($districts, $cart) { ?>
    <main id="shipping">
        <h1>Checkout</h1>
            <div class="flex-container">
                <div class="flex-row">
                    <?php drawSmallProductCard($cart) ?>
                </div>
        </div>
        <section id="shipping-details">
            <form action="payment.php" method="get">
                <fieldset>
                    <legend>Detalhes Pessoais</legend>
                    <label for="name">Nome
                        <input type="text" id="name" name="name" required>
                    </label>
                    <label for="nif">NIF
                        <input type="text" id="nif" name="nif" required>
                    </label>
                    <label for="mobile">Telemóvel
                        <input type="tel" id="mobile" name="mobile" required>
                    </label>
                </fieldset>

                <fieldset>
                    <legend>Detalhes de Endereço</legend>
                    <label id = "regiao">
                        Distrito
                        <select name="district">
                            <option value="">&mdash;</option>
                            <?php foreach ($districts as $district) { ?>
                                <option value="<?php echo $district['locationName']; ?>"><?php echo $district['locationName']; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <label for="street">Rua
                        <input id="street" type="text" name="street"required>
                    </label>
                    <label for="door">Porta
                        <input id="door" type="text" name="door"required>
                    </label>
                    <label for="localidade">Localidade
                        <input id="localidade" type="text" name="localidade"required>
                    </label>
                    <label for="postal_code">Codigo postal
                        <input id="postal_code" type="text" name="postal_code"required>
                    </label>
                    
                </fieldset>

                <fieldset>
                    <legend>Opções de Entrega</legend>
                    <div class="radio-option">
                    <label>
                        <input type="radio" name="delivery_method" value="delivery" checked>
                         <img src="../assets/icons/delivery.png" alt="Delivery Logo"> Entrega ao domicílio
                    </label>
                    </div>
                    <div class="radio-option">
                    <label>
                        <input type="radio" name="delivery_method" value="pickup">  
                        <img src="../assets/icons/pickup.png" alt="Pickup Logo">  Levantamento num ponto PickUp
                    </label>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Método de Pagamento</legend>

                    <div class="radio-option">
                        <label>
                        <input type="radio" name="payment_method" value="card" data-toggle-value="card">   
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
                        <label for="name">Nome do titular
                            <input type="text" id="name" name="name" required>
                        </label>
                        <label for="nif">Número do cartão
                            <input type="number" id="cardID" name="cardID" max="9999999999999999" required>
                        </label>
                        <label for="nif">Validade
                            <input type="month" id="date" name="date" required>
                        </label>
                        <label for="nif">CVV
                            <input type="number" id="cvv" name="cvv" max="999" required>
                        </label>
                    </div>

                    <div data-toggle-group="paypal" style="display: none;">
                        <label for="email">Email
                            <input type="email" id="email" name="email" required>
                        </label>
                        <label for="nif">Password
                            <input type="password" id="password" name="password" required>
                        </label>
                    </div>

                    <div data-toggle-group="mbway" style="display: none;">
                        <label for="mobile">Número de telemóvel
                            <input type="tel" id="mobile" name="mobile" required>
                        </label>
                    </div>
                </fieldset>
                <button type="submit" class = "abtn">Finalizar</button>
            </form>
        </section>
    </main>
<?php } ?>
