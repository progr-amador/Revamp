<?php declare(strict_types = 1); ?>

<?php function drawLogin() { ?>
    <main>
        <div class="login-container">
            <div class="box form-box">
                <header> Iniciar Sessão </header>
                <form action="" method="post">
                    
                    <div class="field input">
                    <label for="email"> Email </label> 
                    <input type="text" name="email" id="email" autocomplete="off" required>
                    </div>
                    <div class="field input">
                    <label for="password"> Password </label> 
                    <input type="text" name="password" id="password" autocomplete="off" required>
                    </div>
                    <div class="field">
                        <input type="submit" class="bbtn" name="submit" value="Login" autocomplete="off" required>
                    </div>
                    <div class="links">
                        Não tem conta? <a href="register.php"> Registe-se. </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php } ?>