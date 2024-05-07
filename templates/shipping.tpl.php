<?php declare(strict_types = 1); ?>

<?php function drawShipping() { ?>
    <main id = "shipping">
        <section id="filters">
        <form>
            <label id = "regiao">
                Distrito
                <select name="regiao">
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
                </select>
            </label>
            <input type="text" name="street" placeholder="Street">
            <input type="text" name="door" placeholder="Door">
            <input type="number" name="postal_code" placeholder="Postal Code">
            <label>
                <button formaction="save.php" formmethod="get" type="submit">
                Submit
                </button>
            </label>
        </form>
        </section>
    </main>
<?php } ?>