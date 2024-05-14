<?php declare(strict_types = 1); ?>

<?php function drawSearch($searched, $categories, $districts, $brands, $conditions, $query) { ?>
    <main id = "search">
        <section id="listings">
            <div class="item-list">
                <div class="flex-container">
                    <div class="flex-row" id="listing-item">
                        <?php drawProductCard($searched) ?>
                    </div>
                </div>
            </div>
        </section>
        <section id="filters">
        <form action="search.php" method="get">
            <input type="hidden" name="title" value="<?php echo $query; ?>">
            <label> 
            Preço
            <fieldset>
                <input type="number" name="price_min" placeholder="0€">
                <input type="number" name="price_max" placeholder="1000€">
            </fieldset>
            </label>
            <label id="condição">
            Condição
            <select name="condition">
                <option value="">&mdash;</option>
                <?php foreach ($conditions as $condition) { ?>
                    <option value="<?php echo $condition['conditionName']; ?>"><?php echo $condition['conditionName']; ?></option>
                <?php } ?>
            </select>
            </label>
            <label id = "regiao">
            Distrito
            <select name="district">
                <option value="">&mdash;</option>
                <?php foreach ($districts as $district) { ?>
                    <option value="<?php echo $district['locationName']; ?>"><?php echo $district['locationName']; ?></option>
                <?php } ?>
            </select>
            </label>
            <label id = "categoria">
            Categoria
            <select name="category">
                <option value="">&mdash;</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category['categoryName']; ?>"><?php echo $category['categoryName']; ?></option>
                <?php } ?>
            </select>
            </label>
            <label id = "marca">
            Marca
            <select name="brand">
                <option value="">&mdash;</option>
                <?php foreach ($brands as $brand) { ?>
                    <option value="<?php echo $brand['brandName']; ?>"><?php echo $brand['brandName']; ?></option>
                <?php } ?>
            </select>
            </label>
            <label>
                <button type="submit" class="abtn">
                Filtrar
                </button>
            </label>
        </form>
        </section>
    </main>
<?php } ?>