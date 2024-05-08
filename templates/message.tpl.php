<?php declare(strict_types = 1); ?>

<?php function drawMessage() { ?>
    <main id = "message">
        <form>
            <!-- onde estariam as mensagens-->
            <input type="text" name="text" placeholder="Text">
            <label>
                <button formaction="save.php" formmethod="get" type="submit">
                Enviar
                </button>
            </label>
        </form>
    </main>
<?php } ?>