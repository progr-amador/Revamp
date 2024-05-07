<?php declare(strict_types = 1); ?>

<?php function drawShipping() { ?>
    <main id="shipping">
        <h1>Informações de Envio</h1>
        <section id="shipping-details">
            <form action="save.php" method="post">
                <!-- Detalhes do Cliente -->
                <fieldset>
                    <legend>Detalhes Pessoais</legend>
                    <label for="name">Nome:
                        <input type="text" id="name" name="name" required>
                    </label>
                    <label for="nif">NIF:
                        <input type="text" id="nif" name="nif" required>
                    </label>
                    <label for="mobile">Número de Telemóvel:
                        <input type="tel" id="mobile" name="mobile" required>
                    </label>
                </fieldset>

                <!-- Detalhes de Endereço -->
                <fieldset>
                    <legend>Detalhes de Endereço</legend>
                    <label for="regiao">Distrito:
                        <select id="regiao" name="regiao">
                            <option value="">&mdash;</option>
                            <optgroup label="Norte">
                                <option value="VC">Viana do Castelo</option>
                                <option value="BR">Braga</option>
                                <option value="VR">Vila Real</option>
                                <option value="BC">Bragança</option>
                                <option value="PT">Porto</option>
                            </optgroup>
                            <optgroup label="Centro">
                                <option value="AV">Aveiro</option>
                                <option value="CO">Coimbra</option>
                                <option value="VI">Viseu</option>
                                <option value="GU">Guarda</option>
                                <option value="CA">Castelo Branco</option>
                                <option value="LE">Leiria</option>
                                <option value="SA">Santarém</option>
                            </optgroup>
                            <optgroup label="Sul">
                                <option value="LI">Lisboa</option>
                                <option value="PL">Portalegre</option>
                                <option value="SE">Setúbal</option>
                                <option value="EV">Évora</option>
                                <option value="BE">Beja</option>
                                <option value="FA">Faro</option>
                            </optgroup>
                            <!-- As opções permanecem inalteradas -->
                        </select>
                    </label>
                    <input type="text" name="street" placeholder="Rua" required>
                    <input type="text" name="door" placeholder="Porta" required>
                    <input type="text" name="localidade" placeholder="Localidade" required>
                    <input type="text" name="postal_code" placeholder="Código Postal" required>
                    
                </fieldset>

                <!-- Opções de Entrega -->
                <fieldset>
                    <legend>Opções de Entrega</legend>
                    <div class="radio-option">
                    <label>
                        <input type="radio" name="delivery_method" value="delivery" checked>
                         <img src="../assets/delivery.png" alt="Credit Card Logos"> Entrega ao Domicílio
                    </label>
                    </div>
                    <div class="radio-option">
                    <label>
                        <input type="radio" name="delivery_method" value="pickup">  
                        <img src="../assets/pickup.png" alt="Credit Card Logos">  Levantamento num Ponto PickUp
                    </label>
                    </div>
                </fieldset>

                <!-- Métodos de Pagamento -->
                <fieldset>
                    <legend>Método de Pagamento</legend>
                    <div class="radio-option">
                        <label>
                        <input type="radio" name="payment_method" value="card" checked>   
                             <img src="../assets/creditcard.png" alt="Credit Card Logos"> Cartão de Crédito
                                
                        </label>
                    </div>
                    <div class="radio-option">
                        <label>
                            <input type="radio" name="payment_method" value="paypal"> 
                             <img src="../assets/paypal.png" alt="PayPal Logo"> PayPal
                            
                        </label>
                    </div>
                    <div class="radio-option">
                        <label>
                            <input type="radio" name="payment_method" value="mbway">
                             <img src="../assets/mbway.png" alt="MB WAY Logo"> MB Way
                            
                        </label>
                    </div>
                </fieldset>

                <button type="submit" class = "abtn" >Submeter</button>
            </form>
        </section>
    </main>
<?php } ?>
