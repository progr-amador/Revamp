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
                    <p><strong>Telefone:</strong> <?php echo $user['phoneNumber'];?></p>
                    <p><strong>Juntou-se em:</strong> <?php echo $user['creationDate'];?> </p>
                </div>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $user['userID']): ?>
                    <form action="edit_profile.php" method="get">
                        <button name="type" type="submit" value="email" class="abtn">Editar Email</button>
                    </form>

                    <form action="edit_profile.php" method="get">
                        <button name="type" type="submit" value="username" class="abtn">Editar Username</button>
                    </form>
                    <form action="../actions/action_logout.php" method="post">
                         <button type="submit" class="abtn"> Terminar Sessão </button>
                    </form>

                    <form action="../actions/control_panel/action_remove_user.php" method="get">
                        <button name="name" type="submit" value="<?php echo $user['username'];?>" class="abtn"> Apagar Conta </button>
                    </form>

                    

                

                <?php endif; ?>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== $user['userID'] && $_SESSION['admin']): ?>
                <form action="../actions/control_panel/action_make_admin.php" method="get">
                    <button name="name" type="submit" value="<?php echo $user['username'];?>" class="abtn"> Tornar Admin </button>
                </form>
                <form action="../actions/control_panel/action_remove_admin.php" method="get">
                    <button name="name" type="submit" value="<?php echo $user['username'];?>" class="abtn"> Retirar Admin </button>
                </form>
                <form action="../actions/control_panel/action_remove_user.php" method="get">
                    <button name="name" type="submit" value="<?php echo $user['username'];?>" class="abtn"> Remover Utilizador </button>
                </form>
                <?php endif; ?>
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

