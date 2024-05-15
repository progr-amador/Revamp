<?php declare(strict_types = 1); ?>

<?php function drawMessage() { ?>
    <main id = "message">
        <div class="container">
            <div class="sidebar">
                <!-- Sidebar content: list of conversations -->
                <ul id="conversation-list">
                    <!-- Conversation items will be dynamically generated here -->
                </ul>
            </div>
            <div class="main">
                <!-- Main content: messages for the selected conversation -->
                <div id="message-display">
                    <!-- Message threads will be dynamically generated here -->
                </div>
                <div class="message-input">
                    <!-- Input field to send new messages -->
                    <textarea id="message-input" placeholder="Type your message"></textarea>
                    <button id="send-button">Send</button>
                </div>
            </div>
        </div>
    </main>
<?php } ?>