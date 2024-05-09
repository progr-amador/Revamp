<?php declare(strict_types = 1); ?>

<?php function drawLogin() { ?>
    <main>
        <div class="login-container">
            <div class="box form-box">
                <header> Iniciar Sessão </header>
                <form action="action_login.php" method="post">
                    <div class="field input">
                    <label for="email"> Email </label> 
                    <input type="email" name="email" id="email" required>
                    </div>
                    <div class="field input">
                    <label for="password"> Password </label> 
                    <input type="password" name="password" id="password" required>
                    </div>
                    <div class="field">
                        <input type="submit" class="bbtn" name="submit">Iniciar sessão</input>
                    </div>
                    <div class="links">
                        Não tem conta? <a href="register.php"> Registe-se. </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php } ?>

<!--autocomplete="off"-->