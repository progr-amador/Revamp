<?php 
declare(strict_types=1);

function drawEditProfile(string $type) {
    $errorMessage = '';
    if (isset($_SESSION['error_message'])) {
        $errorMessage = '<p>' . htmlspecialchars($_SESSION['error_message'], ENT_QUOTES, 'UTF-8') . '</p>';
        unset($_SESSION['error_message']);
    }

    $formConfig = getFormConfig($type);
    ?>

    <main>
        <div class="login-container">
            <div class="box form-box">
                <header>Alterar <?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?></header>
                <form action="../actions/<?php echo htmlspecialchars($formConfig['action'], ENT_QUOTES, 'UTF-8'); ?>" method="post">
                    <div class="field input">
                        <label for="old">Email atual</label>
                        <input type="email" name="old" id="old" required> 
                    </div>
                    <div class="field input">
                        <label for="password">Password atual</label>
                        <input type="password" name="password" id="password" required> 
                    </div>
                    <div class="field input">
                        <label for="new"><?php echo htmlspecialchars($formConfig['newLabel'], ENT_QUOTES, 'UTF-8'); ?></label>
                        <input type="<?php echo htmlspecialchars($formConfig['inputType'], ENT_QUOTES, 'UTF-8'); ?>" name="new" id="new" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="bbtn" value="Alterar <?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                </form>
                <?php echo $errorMessage; ?> 
            </div>
        </div>
    </main>
    <?php 
}

function getFormConfig(string $type): array {
    switch ($type) {
        case 'email':
            return [
                'action' => 'action_change_email.php',
                'newLabel' => 'Email novo',
                'inputType' => 'email'
            ];
        case 'username':
            return [
                'action' => 'action_change_username.php',
                'newLabel' => 'Username novo',
                'inputType' => 'text'
            ];
        case 'password':
            return [
                'action' => 'action_change_password.php',
                'newLabel' => 'Password nova',
                'inputType' => 'password'
            ];
        default:
            return [
                'action' => 'default_action.php',
                'newLabel' => 'Default label',
                'inputType' => 'text'
            ];
    }
}
?>
