<?php 
declare(strict_types=1);

session_start();

function drawLogin(): void {
    $errorMessage = '';
    if (isset($_SESSION['error_message'])) {
        $errorMessage = '<p>' . htmlspecialchars($_SESSION['error_message'], ENT_QUOTES, 'UTF-8') . '</p>';
        unset($_SESSION['error_message']);
    }
    ?>
    <main>
        <div class="login-container">
            <div class="box form-box">
                <header>Iniciar Sessão</header>
                <form action="../actions/action_login.php" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars(generateCSRFToken(), ENT_QUOTES, 'UTF-8'); ?>"> 
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" required>
                    </div>
                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="field">
                        <input type="submit" class="bbtn" value="Iniciar sessão"> 
                    </div>
                    <div class="links">
                        Não tem conta? <a href="register.php">Registe-se.</a>
                    </div>
                </form>
                <?php echo $errorMessage; ?>
            </div>
        </div>
    </main>
    <?php
}
?>
