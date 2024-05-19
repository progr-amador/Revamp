<?php declare(strict_types = 1); ?>

<?php function drawRegister(): void { 
    $errorMessage = '';
    if (isset($_SESSION['error_message'])) {
        $errorMessage = '<p>' . htmlspecialchars($_SESSION['error_message'], ENT_QUOTES, 'UTF-8') . '</p>';
        unset($_SESSION['error_message']);
    }
    ?>
    <main>
        <div class="login-container">
            <div class="box form-box">
                <header> Criar Conta </header>
                <form action="../actions/action_register.php" method="post">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>"> 
                    <div class="field input">
                    <label for="username"> Username </label> 
                    <input type="text" name="username" id="username" autocomplete="off" required>
                    </div>
                    <div class="field input">
                    <label for="email"> Email </label> 
                    <input type="email" name="email" id="email" required>
                    </div>
                    <div class="field input">
                    <label for="password"> Password </label> 
                    <input type="password" name="password" id="password" required>
                    </div>
                    <div class="field">
                        <input type="submit" class="bbtn" value="Criar Conta" name="submit"></input>
                    </div>
                    <div class="links">
                        Já tem conta? <a href="login.php"> Inicie sessão.</a>
                    </div>
                </form>
                <?php echo $errorMessage; ?>
            </div>
        </div>
    </main>
<?php } ?>