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
                    <p><strong>Email:</strong> <?php echo $user['email'];?></p>
                    <p><strong>Telefone:</strong> <?php echo $user['phoneNumber'];?></p>
                    <p><strong>Juntou-se em:</strong> <?php echo $user['creationDate'];?> </p>
                </div>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user['userID']): ?>
                <form action="../actions/action_logout.php" method="post">
                    <button type="submit" class="abtn"> Terminar Sessão </button>
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
