<?php 
declare(strict_types = 1);


function drawEditProfile(string $type) {
    // Check for an error message and prepare it before HTML starts
    $errorMessage = '';
    if (isset($_SESSION['error_message'])) {
        $errorMessage = '<p>' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']);
    }

    switch ($type) {
        case 'email':
            $action = 'action_changeEmail.php';
            $newLabel1 = 'Email novo';
            $inputType = 'email';
            break;
        case 'username':
            $action = 'action_changeUsername.php';
            $newLabel1 = 'Username novo';
            $inputType = 'text';
            break;
        case 'password':
            $action = 'action_changePassword.php';
            $newLabel1 = 'Password novo';
            $inputType = 'password';
            break;
        default:
            // Handle unknown type if necessary
            $action = 'default_action.php';
            $newLabel1 = 'Default label';
            $inputType = 'text';
            break;
    }
    
    
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
                    <input type="<?php echo $inputType; ?>" name="new" id="new" required>
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