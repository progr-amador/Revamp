<?php declare(strict_types = 1); ?>

<?php function drawMessage() { ?>
    <main id = "shipping">
        <section id="filters">
        <form>
            <!-- onde estariam as mensagens-->
            <input type="text" name="text" placeholder="Text">
            <label>
                <button formaction="save.php" formmethod="get" type="submit">
                Send
                </button>
            </label>
        </form>
        </section>
    </main>
<?php } ?>