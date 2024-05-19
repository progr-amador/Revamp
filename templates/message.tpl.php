<?php declare(strict_types = 1); ?>

<?php function drawMessage($chats, $messages, $conversation = 0) { ?>
    <main>
        <h1>Mensagens</h1>
        <div id = "message-page">
            <div id="sidebar">
                <div class="flex-row">
                    <?php drawChatCard($chats) ?>
                </div>
            </div>
            <div id="message">
                <div id="message-display">
                    <?php if($conversation !== 0){ 
                        drawMessageCard($messages) ;
                    } else {
                        echo '<h4 id="default">Selecione uma conversa</h4>';
                    }  ?>
                </div>
                <?php if($conversation !== 0): ?>
                    <div class="message-input">
                        <form action="../actions/action_send_message.php" method="post">
                            input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                            <input type="hidden" value="<?php echo $conversation ?>" name="chatID">
                            <input type="text" name="message-input" required>
                            <button type="submit" class="abtn"><i class="material-icons">send</i></button>
                        </form>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </main>
<?php } ?>

<?php function drawChatCard($chats) {
    foreach ($chats as $chat) { ?>
        <div class="small-flex-item">
            <a href="message.php?chatID=<?php echo $chat['chatID'] ?>">
                <div class="small-item-image">
                    <img src="<?php echo $chat['photoURL'] ?>" alt="Image of <?php echo $chat['title'] ?>">
                </div>
                <div class="small-item-details">
                    <p id="title"><?php echo $chat['title'] ?></p>
                    <p id="username"><?php echo $_SESSION['user_id'] == $chat['sellerID'] ? $chat['buyerName'] : $chat['sellerName'] ?></p>
                    <p id="status"><?php echo $_SESSION['user_id'] == $chat['sellerID'] ? "A vender" : "A comprar" ?></p>
                </div>
            </a>
        </div>
    <?php }
} ?>

<?php function drawMessageCard($messages) {
    foreach ($messages as $message) { ?>
        <div class="message-item" <?php echo $message['senderID'] == $_SESSION['user_id'] ? 'id="me"' : 'id="other"' ?>>
            <h4><?php echo $message['senderName'] . " - " . date('H:i d/m/Y', strtotime($message['messageDate'])); ?></h4>
            <p id="text-message"><?php echo $message['messageText'] ?></p>
        </div>
    <?php }
} ?>
