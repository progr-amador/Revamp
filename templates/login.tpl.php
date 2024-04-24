<?php declare(strict_types = 1); ?>

<?php function drawLogin() { ?>
    <main>
        <div class="login-container">
            <div class="box form-box">
                <header> Login </header>
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
                        <input type="submit" class="btn" name="submit" value="Login" autocomplete="off" required>
                    </div>
                    <div class="links">
                        Don't have account? <a href="register.php"> Sign Up. </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php } ?>