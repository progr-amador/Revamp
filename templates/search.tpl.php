<?php declare(strict_types=1); ?>

<?php function drawSearch(array $searched, array $categories, array $districts, array $brands, array $conditions): void { ?>
    <main id="search">
        <section id="filters">
            <label> 
                Preço
                <fieldset>
                    <label id="price_min"><input type="number" name="price_min" placeholder="0€"></label>
                    <label id="price_max"><input type="number" name="price_max" placeholder="1000€"></label>
                </fieldset>
            </label>
            <label id="ordem">
                Ordenar
                <select name="order">
                    <option value="">&mdash;</option>
                    <option value="price ASC">Preço ascendente</option>
                    <option value="price DESC">Preço descendente</option>
                    <option value="title ASC">Nome ascendente</option>
                    <option value="title DESC">Nome descendente</option>
                </select>
            </label>
            <label id="condição">
                Condição
                <select name="condition">
                    <option value="">&mdash;</option>
                    <?php foreach ($conditions as $condition): ?>
                        <option value="<?php echo htmlspecialchars($condition['conditionName'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($condition['conditionName'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
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
            <label id="categoria">
                Categoria
                <select name="category">
                    <option value="">&mdash;</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category['categoryName'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($category['categoryName'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label id="marca">
                Marca
                <select name="brand">
                    <option value="">&mdash;</option>
                    <?php foreach ($brands as $brand): ?>
                        <option value="<?php echo htmlspecialchars($brand['brandName'], ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($brand['brandName'], ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
        </section>
        <section id="listings">
            <div class="item-list">
                <div class="flex-container">
                    <div class="flex-row" id="listing-item">
                        <?php drawProductCard($searched); ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php } ?>
