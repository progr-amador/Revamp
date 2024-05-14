<?php declare(strict_types = 1); ?>

<?php function drawControlPanel($featured) { ?>
    <main>
        <fieldset>
            <legend>Utilizadores</legend>
            <form action="../actions/control_panel/action_make_admin.php" method="post">
                <input type="text" name="name" placeholder="Nome de Utilizador">
                <button type="submit" class="abtn"> Tornar Admin </button>
            </form>
            <form action="../actions/control_panel/action_remove_admin.php" method="post">
                <input type="text" name="name" placeholder="Nome de Utilizador">
                <button type="submit" class="abtn"> Retirar Admin </button>
            </form>
            <form action="../actions/control_panel/action_remove_user.php" method="post">
                <input type="text" name="name" placeholder="Nome de Utilizador">
                <button type="submit" class="abtn"> Remover Utilizador </button>
            </form>
        </fieldset>

        <fieldset>
            <legend>Categorias</legend>
            <form action="../actions/control_panel/action_add_category.php" method="post">
                <input type="text" name="name" placeholder="Nome da Categoria">
                <button type="submit" class="abtn"> Adicionar Categoria </button>
            </form>
            <form action="../actions/control_panel/action_remove_category.php" method="post">
                <input type="text" name="name" placeholder="Nome da Categoria">
                <button type="submit" class="abtn"> Remover Categoria </button>
            </form>
        </fieldset>

        <fieldset>
            <legend>Distritos</legend>
            <form action="../actions/control_panel/action_add_district.php" method="post">
                <input type="text" name="name" placeholder="Nome do Distrito">
                <button type="submit" class="abtn"> Adicionar Distrito </button>
            </form>
            <form action="../actions/control_panel/action_remove_district.php" method="post">
                <input type="text" name="name" placeholder="Nome do Distrito">
                <button type="submit" class="abtn"> Remover Distrito </button>
            </form>
        </fieldset>

        <fieldset>
            <legend>Marcas</legend>
            <form action="../actions/control_panel/action_add_brand.php" method="post">
                <input type="text" name="name" placeholder="Nome da Marca">
                <button type="submit" class="abtn"> Adicionar Marca </button>
            </form>
            <form action="../actions/control_panel/action_remove_brand.php" method="post">
                <input type="text" name="name" placeholder="Nome da Marca">
                <button type="submit" class="abtn"> Remover Marca </button>
            </form>
            </fieldset>

        <fieldset>
            <legend>Condições</legend>
            <form action="../actions/control_panel/action_add_condition.php" method="post">
                <input type="text" name="name" placeholder="Nome da Condição">
                <button type="submit" class="abtn"> Adicionar Condição </button>
            </form>
            <form action="../actions/control_panel/action_remove_condition.php" method="post">
                <input type="text" name="name" placeholder="Nome da Condição">
                <button type="submit" class="abtn"> Remover Condição </button>
            </form>
        </fieldset>
    </main>
<?php } ?>
