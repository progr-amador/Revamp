<?php declare(strict_types = 1); ?>

<?php function drawSearch($searched) { ?>
    <main id = "search">
        <section id="listings">
        <div class="flex-container">
            <div class="flex-row">
                <?php drawProductCard($searched) ?>
            </div>
        </div>
        </section>
        <section id="filters">
        <form>
            <label> 
            Preço
            <fieldset>
                <input type="number" name="more than" placeholder="0€">
                <input type="number" name="less than" placeholder="1000€">
            </fieldset>
            </label>
            <label>
            Condição
            <fieldset id = "estado">
                <label>Como novo<input type="checkbox" name="como novo" ></label>
                <label>Muito bom<input type="checkbox" name="muito bom"></label>
                <label>Bom<input type="checkbox" name="bom"></label>
                <label>Satisfatório<input type="checkbox" name="satisfatorio"></label>
            </fieldset>
            </label>
            <label id = "regiao">
            Região
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
            <label id = "categoria">
            Categoria
            <select name="categoria">
                <option value="">&mdash;</option>
                <optgroup label="Tecnologia">
                    <option value="TL">Telemóveis</option>
                    <option value="PC">PC's</option>
                </optgroup>
                <optgroup label="Moda">
                    <option value="AV">Camisolas</option>
                    <option value="CO">Calças</option>
                </optgroup>
                <optgroup label="Porsche">
                    <option value="LI">Panamera</option>
                    <option value="LI">911</option>
                    <option value="LI">Ioniq 6</option>
                    <option value="PL">Carrera</option>
                </optgroup>
            </select>
            </label>
            <label>
                <button formaction="save.php" formmethod="get" type="submit">
                Submit
                </button>
            </label>
        </form>
        </section>
    </main>
<?php } ?>