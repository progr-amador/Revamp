<?php 
declare(strict_types = 1);


function drawEditProfile(string $type) {
    // Check for an error message and prepare it before HTML starts
    $errorMessage = '';
    if (isset($_SESSION['error_message'])) {
        $errorMessage = '<p>' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']);
    }

    $action = $type === 'email' ? 'action_changeEmail.php' : 'action_changeUsername.php';
    $newLabel1 = $type === 'email' ? 'Email novo' : 'Username novo';
    
?>

<main>
    <div class="login-container">
        <div class="box form-box">
            <header>Alterar <?php echo $type; ?></header>
            <form action="../actions/<?php echo $action; ?>" method="post">
                <div class="field input">
                    <label for="old"><?php echo "Email atual"; ?></label>
                    <input type="email" name="old" id="old" required> <!-- Change input type based on type -->
                </div>
                <div class="field input">
                    <label for="password"><?php echo "Password atual" ?></label>
                    <input type="password" name="password" id="password" required> <!-- Change input type based on type -->
                </div>
                <div class="field input">
                    <label for="new"><?php echo $newLabel1; ?></label>
                    <input type="<?php echo $type === 'email' ? 'email' : 'text'; ?>" name="new" id="new" required>
                </div>
                
                <div class="field">
                    <input type="submit" class="bbtn" value="Alterar <?php echo $type; ?>">
                </div>
            </form>
            <?php echo $errorMessage; ?> <!-- Display the error message here -->
        </div>
    </div>
</main>
<?php 
}
?>