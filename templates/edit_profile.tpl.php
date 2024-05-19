<?php 
declare(strict_types = 1);


function drawEditProfile(string $type) {
    $csrf_token = generateCsrfToken();
    $errorMessage = '';
    if (isset($_SESSION['error_message'])) {
        $errorMessage = '<p>' . htmlspecialchars($_SESSION['error_message']) . '</p>';
        unset($_SESSION['error_message']);
    }
    

    switch ($type) {
        case 'email':
            $action = 'action_change_email.php';
            $newLabel1 = 'Email novo';
            $inputType = 'email';
            break;
        case 'username':
            $action = 'action_change_username.php';
            $newLabel1 = 'Username novo';
            $inputType = 'text';
            break;
        case 'password':
            $action = 'action_change_password.php';
            $newLabel1 = 'Password novo';
            $inputType = 'password';
            break;
        default:
            $action = 'default_action.php';
            $newLabel1 = 'Default label';
            $inputType = 'text';
            break;
    }
    
    
?>

<main>
    <div class="login-container">
        <div class="box form-box">
            <header>Alterar <?php echo htmlspecialchars($type); ?></header>
            <form action="../actions/<?php echo htmlspecialchars($action); ?>" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                <div class="field input">
                    <label for="old"><?php echo "Email atual"; ?></label>
                    <input type="email" name="old" id="old" required> 
                </div>
                <div class="field input">
                    <label for="password"><?php echo "Password atual" ?></label>
                    <input type="password" name="password" id="password" required> 
                </div>
                <div class="field input">
                    <label for="new"><?php echo htmlspecialchars($newLabel1); ?></label>
                    <input type="<?php echo htmlspecialchars($inputType); ?>" name="new" id="new" required>
                </div>

                <div class="field">
                    <input type="submit" class="bbtn" value="Alterar <?php echo htmlspecialchars($type); ?>">
                </div>
            </form>
            <?php echo $errorMessage; ?> 
        </div>
    </div>
</main>
<?php 
}
?>