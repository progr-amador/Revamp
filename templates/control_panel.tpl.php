<?php declare(strict_types=1); ?>

<?php
function drawControlPanel() {
    $csrf_token = generateCsrfToken();
?>
    <main>
        <h1>Painel de controlo</h1>
        <fieldset>
            <legend><h2>Utilizadores</h2></legend>
            <form action="../actions/control_panel/action_make_admin.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <input type="text" name="name" placeholder="Nome de Utilizador" required>
                <button type="submit" class="abtn">Tornar Admin</button>
            </form>
            <form action="../actions/control_panel/action_remove_admin.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <input type="text" name="name" placeholder="Nome de Utilizador" required>
                <button type="submit" class="abtn">Retirar Admin</button>
            </form>
            <form action="../actions/control_panel/action_remove_user.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <input type="text" name="name" placeholder="Nome de Utilizador" required>
                <button type="submit" class="abtn">Remover Utilizador</button>
            </form>
        </fieldset>
 
        <fieldset>
            <legend><h2>Categorias</h2></legend>
            <form action="../actions/control_panel/action_add_category.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <input type="text" name="name" placeholder="Nome da Categoria" required>
                <button type="submit" class="abtn">Adicionar Categoria</button>
            </form>
            <form action="../actions/control_panel/action_remove_category.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <input type="text" name="name" placeholder="Nome da Categoria" required>
                <button type="submit" class="abtn">Remover Categoria</button>
            </form>
        </fieldset>

        <fieldset>
            <legend><h2>Distritos</h2></legend>
            <form action="../actions/control_panel/action_add_district.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <input type="text" name="name" placeholder="Nome do Distrito" required>
                <button type="submit" class="abtn">Adicionar Distrito</button>
            </form>
            <form action="../actions/control_panel/action_remove_district.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <input type="text" name="name" placeholder="Nome do Distrito" required>
                <button type="submit" class="abtn">Remover Distrito</button>
            </form>
        </fieldset>

        <fieldset>
            <legend><h2>Marcas</h2></legend>
            <form action="../actions/control_panel/action_add_brand.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <input type="text" name="name" placeholder="Nome da Marca" required>
                <button type="submit" class="abtn">Adicionar Marca</button>
            </form>
            <form action="../actions/control_panel/action_remove_brand.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <input type="text" name="name" placeholder="Nome da Marca" required>
                <button type="submit" class="abtn">Remover Marca</button>
            </form>
        </fieldset>

        <fieldset>
            <legend><h2>Condições</h2></legend>
            <form action="../actions/control_panel/action_add_condition.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <input type="text" name="name" placeholder="Nome da Condição" required>
                <button type="submit" class="abtn">Adicionar Condição</button>
            </form>
            <form action="../actions/control_panel/action_remove_condition.php" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <input type="text" name="name" placeholder="Nome da Condição" required>
                <button type="submit" class="abtn">Remover Condição</button>
            </form>
        </fieldset>
    </main>
<?php } ?>
