<div class="page-header">
    <div class="container">
        <h1><?php e($title); ?></h1>
    </div>
</div>
<section class="content">
    <div class="message-container">
        <?php
        $messages = fetch_all_messages();
        foreach ($messages as $msg):
        ?>
            <div class="message-card">

                <div class="message-header">
                    <?= htmlspecialchars($msg['email']) ?>
                </div>

                <p class="message-content">
                    <?= nl2br(htmlspecialchars_decode($msg['messages'])) ?>
                </p>

                <div class="message-header">
                    <?= htmlspecialchars($msg['created_at']) ?>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</section>