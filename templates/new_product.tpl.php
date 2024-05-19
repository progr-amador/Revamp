<?php declare(strict_types=1); ?>

<?php
function drawNewProduct(array $districts, array $categories, array $brands, array $conditions): void {
    $errorMessage = '';
    if (isset($_SESSION['error_message'])) {
        $errorMessage = '<p>' . htmlspecialchars($_SESSION['error_message'], ENT_QUOTES, 'UTF-8') . '</p>';
        unset($_SESSION['error_message']);
    }
    ?>
    <main id="shipping">
        <h1>Novo Produto</h1>
        <section id="shipping-details">
            <form action="../actions/action_new_product.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Texto</legend>
                    <label for="title">Título
                        <input type="text" id="title" name="title" maxlength="42" required>
                    </label>
                    <br>
                    <label for="description"> Descrição</label>
                    <br>
                    <textarea id="description" name="description" rows="15" maxlength="2100" required></textarea>
                </fieldset>

                <fieldset>
                    <legend>Detalhes</legend>
                    <label for="price">Preço
                        <input type="number" id="price" name="price" max="2000" required>
                    </label>
                    <br>
                    <label id="categoria">
                        Categoria
                        <select name="category" required>
                            <option value="">&mdash;</option>
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo htmlspecialchars((string)$category['categoryID'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($category['categoryName'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </label>
                    <label id="marca">
                        Marca
                        <select name="brand" required>
                            <option value="">&mdash;</option>
                            <?php foreach ($brands as $brand) { ?>
                                <option value="<?php echo htmlspecialchars((string)$brand['brandID'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($brand['brandName'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </label>
                    <label id="condition">
                        Condição
                        <select name="condition" required>
                            <option value="">&mdash;</option>
                            <?php foreach ($conditions as $condition) { ?>
                                <option value="<?php echo htmlspecialchars((string)$condition['conditionID'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($condition['conditionName'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </label>
                    <label id="regiao">
                        Distrito
                        <select name="location" required>
                            <option value="">&mdash;</option>
                            <?php foreach ($districts as $district) { ?>
                                <option value="<?php echo htmlspecialchars((string)$district['locationID'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <?php echo htmlspecialchars($district['locationName'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
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

                <button type="submit" class="abtn">Publicar</button>
            </form>
        </section>
    </main>
<?php } ?>