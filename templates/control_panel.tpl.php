<?php declare(strict_types=1); ?>

<?php
function drawControlPanel() {
    function drawForm($action, $placeholder, $buttonText) {
        return '
        <form action="' . htmlspecialchars($action, ENT_QUOTES, 'UTF-8') . '" method="post">
            <input type="text" name="name" placeholder="' . htmlspecialchars($placeholder, ENT_QUOTES, 'UTF-8') . '" required>
            <button type="submit" class="abtn">' . htmlspecialchars($buttonText, ENT_QUOTES, 'UTF-8') . '</button>
        </form>';
    }

    ?>
    <main>
        <h1>Painel de controlo</h1>
        <fieldset>
            <legend><h2>Utilizadores</h2></legend>
            <?php
            echo drawForm('../actions/control_panel/action_make_admin.php', 'Nome de Utilizador', 'Tornar Admin');
            echo drawForm('../actions/control_panel/action_remove_admin.php', 'Nome de Utilizador', 'Retirar Admin');
            echo drawForm('../actions/control_panel/action_remove_user.php', 'Nome de Utilizador', 'Remover Utilizador');
            ?>
        </fieldset>

        <fieldset>
            <legend><h2>Categorias</h2></legend>
            <?php
            echo drawForm('../actions/control_panel/action_add_category.php', 'Nome da Categoria', 'Adicionar Categoria');
            echo drawForm('../actions/control_panel/action_remove_category.php', 'Nome da Categoria', 'Remover Categoria');
            ?>
        </fieldset>

        <fieldset>
            <legend><h2>Distritos</h2></legend>
            <?php
            echo drawForm('../actions/control_panel/action_add_district.php', 'Nome do Distrito', 'Adicionar Distrito');
            echo drawForm('../actions/control_panel/action_remove_district.php', 'Nome do Distrito', 'Remover Distrito');
            ?>
        </fieldset>

        <fieldset>
            <legend><h2>Marcas</h2></legend>
            <?php
            echo drawForm('../actions/control_panel/action_add_brand.php', 'Nome da Marca', 'Adicionar Marca');
            echo drawForm('../actions/control_panel/action_remove_brand.php', 'Nome da Marca', 'Remover Marca');
            ?>
        </fieldset>

        <fieldset>
            <legend><h2>Condições</h2></legend>
            <?php
            echo drawForm('../actions/control_panel/action_add_condition.php', 'Nome da Condição', 'Adicionar Condição');
            echo drawForm('../actions/control_panel/action_remove_condition.php', 'Nome da Condição', 'Remover Condição');
            ?>
        </fieldset>
    </main>
    <?php
}
?>
