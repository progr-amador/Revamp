<?php declare(strict_types = 1); ?>

<?php function drawRegister() { ?>
    <main>
        <div class="login-container">
            <div class="box form-box">
                <header> Criar Conta </header>
                <form action="" method="post">
                    <div class="field input">
                    <label for="username"> Username </label> 
                    <input type="text" name="username" id="username" autocomplete="off" required>
                    </div>
                    <div class="field input">
                    <label for="email"> Email </label> 
                    <input type="text" name="email" id="email" autocomplete="off" required>
                    </div>
                    <div class="field input">
                    <label for="password"> Password </label> 
                    <input type="text" name="password" id="password" autocomplete="off" required>
                    </div>
                    <div class="field">
                        <input type="submit" class="bbtn" name="submit" value="Create Account" required>
                    </div>
                    <div class="links">
                        Já tem conta? <a href="login.php"> Inicie sessão.</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php } ?>