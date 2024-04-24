<?php declare(strict_types = 1); ?>

<?php function drawRegister() { ?>
    <main>
        <div class="login-container">
            <div class="box form-box">
                <header> Sign Up </header>
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
                        <input type="submit" class="btn" name="submit" value="Create Account" required>
                    </div>
                    <div class="links">
                        Already a member? <a href="login.php"> Sign In.</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php } ?>