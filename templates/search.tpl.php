<?php declare(strict_types = 1); ?>

<?php function drawSearch() { ?>
    <main>
        <section id="listings">
        <div class="flex-container">
            <div class="flex-row">
                <div class="flex-item"> 
                    <img src="../temp/gato.png"  alt="no image">
                    <p> Gato </p>
                </div>
                <div class="flex-item"> 
                    <img src="../temp/gato.png"  alt="no image">
                    <p> Gato </p>
                </div>
                <div class="flex-item"> 
                    <img src="../temp/gato.png"  alt="no image">
                    <p> Gato </p>
                </div>
                <div class="flex-item"> 
                    <img src="../temp/gato.png"  alt="no image">
                    <p> Gato </p>
                </div>
                <div class="flex-item"> 
                    <img src="../temp/gato.png"  alt="no image">
                    <p> Gato </p>
                </div>
            </div>
        </div>
        </section>
        <section id="filters">
        <form>
            <fieldset>
                <legend>Preço</legend>
                <br>
                De: 
                <input type="number" name="more than" placeholder="0€">
                Até:
                <input type="number" name="less than" placeholder="1000€">
            </fieldset>
            <br>
            <fieldset>
                <legend>Condição</legend>       
                <label>Como novo<input type="checkbox" name="como novo" ></label>
                <label>Muito bom<input type="checkbox" name="muito bom"></label>
                <label>Bom<input type="checkbox" name="bom"></label>
                <label>Satisfatório<input type="checkbox" name="satisfatorio"></label>
            </fieldset>
            <br>
            <label>
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
            <br>
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
            <br>
            <label>
                <button formaction="save.php" formmethod="get" type="submit">
                Submit
                </button>
            </label>
        </form>
        </section>
    </main>
<?php } ?>