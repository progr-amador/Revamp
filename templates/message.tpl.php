<?php declare(strict_types=1); ?>

<?php
function drawMessage(array $chats, array $messages, int $conversation = 0): void { ?>
    <main>
        <h1>Mensagens</h1>
        <div id="message-page">
            <div id="sidebar">
                <div class="flex-row">
                    <?php drawChatCard($chats); ?>
                </div>
            </div>
            <div id="message">
                <div id="message-display">
                    <?php
                    if ($conversation !== 0) {
                        drawMessageCard($messages);
                    } else {
                        echo '<h4 id="default">Selecione uma conversa</h4>';
                    } ?>
                </div>
                <?php if ($conversation !== 0): ?>
                    <div class="message-input">
                        <form action="../actions/action_send_message.php" method="post">
                            <input type="hidden" name="chatID" value="<?php echo htmlspecialchars((string)$conversation, ENT_QUOTES, 'UTF-8'); ?>">
                            <input type="text" name="message-input" required>
                            <button type="submit" class="abtn"><i class="material-icons">send</i></button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
<?php }

function drawChatCard(array $chats): void {
    foreach ($chats as $chat) { ?>
        <div class="small-flex-item">
            <a href="message.php?chatID=<?php echo htmlspecialchars((string)$chat['chatID'], ENT_QUOTES, 'UTF-8'); ?>">
                <div class="small-item-image">
                    <img src="<?php echo htmlspecialchars($chat['photoURL'], ENT_QUOTES, 'UTF-8'); ?>" alt="Image of <?php echo htmlspecialchars($chat['title'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="small-item-details">
                    <p id="title"><?php echo htmlspecialchars($chat['title'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p id="username"><?php echo $_SESSION['user_id'] == $chat['sellerID'] ? htmlspecialchars($chat['buyerName'], ENT_QUOTES, 'UTF-8') : htmlspecialchars($chat['sellerName'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p id="status"><?php echo $_SESSION['user_id'] == $chat['sellerID'] ? "A vender" : "A comprar"; ?></p>
                </div>
            </a>
        </div>
    <?php }
}

function drawMessageCard(array $messages): void {
    foreach ($messages as $message) { ?>
        <div class="message-item" id="<?php echo $message['senderID'] == $_SESSION['user_id'] ? 'me' : 'other'; ?>">
            <h4><?php echo htmlspecialchars($message['senderName'], ENT_QUOTES, 'UTF-8') . " - " . date('H:i d/m/Y', strtotime($message['messageDate'])); ?></h4>
            <p id="text-message"><?php echo htmlspecialchars($message['messageText'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
    <?php }
}
?>
