<?php declare(strict_types = 1); ?>

<?php function drawRegister() { ?>
    <main>
        <div class="login-container">
            <div class="box form-box">
                <header> Criar Conta </header>
                <form action="../actions/action_register.php" method="post">
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
            </div>
        </div>
    </main>
<?php } ?>