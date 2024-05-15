<?php declare(strict_types = 1); ?>

<?php function drawNewProduct($districts, $categories, $brands, $conditions) { 
    $errorMessage = '';
    if (isset($_SESSION['error_message'])) {
        $errorMessage = '<p>' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']);
    }
    ?>
    <main id="shipping">
        <h1>Novo Produto</h1>
        <section id="shipping-details">
            <form action="../actions/action_new_product.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Texto</legend>
                    <label for="name">Título
                        <input type="text" id="name" name="title" required>
                    </label>
                    <br>
                    <label for="description"> Descrição</label>
                    <br>
                    <textarea id="description" name="description" rows="15" required></textarea>
                    
                </fieldset>

                <fieldset>
                    <legend> Detalhes </legend>
                    <label for="name">Preço
                        <input type="text" id="name" name="price" required>
                    </label>
                    <br>
                    <label id = "categoria">
                        Categoria
                        <select name="category" required>
                            <option value="">&mdash;</option>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category['categoryID']; ?>"><?php echo $category['categoryName']; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <label id = "marca">
                        Marca
                        <select name="brand" required>
                            <option value="">&mdash;</option>
                            <?php foreach ($brands as $brand) { ?>
                                <option value="<?php echo $brand['brandID']; ?>"><?php echo $brand['brandName']; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <label id = "condition">
                        Condição
                        <select name="condition" required>
                            <option value="">&mdash;</option>
                            <?php foreach ($conditions as $condition) { ?>
                                <option value="<?php echo $condition['conditionID']; ?>"><?php echo $condition['conditionName']; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <label id = "regiao">
                        Distrito
                        <select name="location" required>
                            <option value="">&mdash;</option>
                            <?php foreach ($districts as $district) { ?>
                                <option value="<?php echo $district['locationID']; ?>"><?php echo $district['locationName']; ?></option>
                            <?php } ?>
                        </select>
                    </label>
                </fieldset>

                <fieldset>
                    <legend>Imagens</legend>
                    <label for="images">Selecione até 4 imagens</label>
                    <input type="file" name="image[]" id="images" accept=".jpeg,.jpg,.png" multiple required>
                    <?php echo $errorMessage; ?>
                </fieldset>

                <button type="submit" class = "abtn">Publicar</button>
            </form>
        </section>
    </main>
<?php } ?>
