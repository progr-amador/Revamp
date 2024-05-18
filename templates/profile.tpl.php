<?php declare(strict_types = 1); ?>

<?php function drawProfile($listings, $user) { ?>
    <main>
        <body>
            <div class="profile-container">
                <div class="profile-header">
                    <img src="../assets/icons/person.jpg" alt="Foto de perfil" height=200px  class="profile-photo">
                    <h1><?php echo $user['username'];?></h1>
                </div>
                <div class="profile-info">
                <p><strong>Email:</strong> <span id="emailText"><?php echo $user['email'];?></p>
                    
                    <p><strong>Juntou-se em:</strong> <?php echo date('d/m/Y', strtotime($user['creationDate'])) ;?> </p>
                </div>
                <div class="buttons" id="buttons-profile">
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $user['userID']): ?>
                        <?php if ($_SESSION['admin']): ?>
                            <form action="control_panel.php" method="get">
                                <button type="submit" class="abtn" title="Painel de Controlo"> <i class="material-icons">tune</i> </button>
                            </form>
                        <?php endif; ?>
                        <form action="edit_profile.php" method="get">
                            <button name="type" type="submit" value="email" title="Editar e-mail"class="abtn"><i class="material-icons">mail</i></button>
                        </form>
                        <form action="edit_profile.php" method="get">
                            <button name="type" type="submit" value="username" title="Editar username" class="abtn"><i class="material-icons">badge</i></button>
                        </form>
                        <form action="edit_profile.php" method="get">
                            <button name="type" type="submit" value="password" title="Editar password" class="abtn"><i class="material-icons">password</i></button>
                        </form>
                        <form action="message.php?" method="get">
                            <button type="submit" class="abtn"><i title="Mensagens" class="material-icons">chat</i></button>
                        </form>
                        <form action="../code/reserved.php" method="get">
                            <button type="submit" class="abtn"><i title="Produtos Reservados" class="material-icons">task_alt</i></button>
                        </form>
                        <form action="../actions/action_logout.php" method="post">
                            <button type="submit" class="abtn" title="Terminar Sessão"> <i class="material-icons">logout</i> </button>
                        </form>
                        <form action="../actions/control_panel/action_remove_user.php" method="get">
                            <button name="name" type="submit" title="Apagar Conta"value="<?php echo $user['username'];?>" class="abtn"><i class="material-icons">person_off</i></button>
                        </form>
                    <?php endif; ?>
                    <?php if ((isset($_SESSION['user_id'])) && ($_SESSION['user_id'] !== $user['userID']) && ($_SESSION['admin'])): ?>
                        <?php if ($user['isAdmin']): ?>
                            <form action="../actions/control_panel/action_remove_admin.php" method="get">
                                <button name="name" type="submit" value="<?php echo $user['username'];?>" class="abtn"><i class="material-icons">remove_moderator</i></button>
                            </form>
                        <?php else: ?>
                            <form action="../actions/control_panel/action_make_admin.php" method="get">
                                <button name="name" type="submit" value="<?php echo $user['username'];?>" class="abtn"> <i class="material-icons">add_moderator</i> </button>
                            </form>
                        <?php endif; ?>
                        <form action="../actions/control_panel/action_remove_user.php" method="get">
                            <button name="name" type="submit" value="<?php echo $user['username'];?>" class="abtn"> <i class="material-icons">person_off</i> </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="item-list">
                    <h2>Os Meus Produtos</h2>
                    <div class="flex-container">
                        <div class="flex-row">
                            <?php drawProductCard($listings) ?>
                        </div>
                    </div>
            </div>
        </body>
    <main>

<?php } ?>

