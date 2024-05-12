<?php 
declare(strict_types = 1);
session_start(); // Ensure session is started

function drawLogin() {
    // Check for an error message and prepare it before HTML starts
    $errorMessage = '';
    if (isset($_SESSION['error_message'])) {
        $errorMessage = '<p>' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']);
    }
?>
<main>
    <div class="login-container">
        <div class="box form-box">
            <header>Iniciar Sessão</header>
            <form action="../actions/action_login.php" method="post">
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="field">
                    <input type="submit" class="bbtn" value="Iniciar sessão"> <!-- Correct input syntax for submit button -->
                </div>
                <div class="links">
                    Não tem conta? <a href="register.php">Registe-se.</a>
                </div>
            </form>
            <?php echo $errorMessage; ?> <!-- Display the error message here -->
        </div>
    </div>
</main>
<?php 
}
?>
