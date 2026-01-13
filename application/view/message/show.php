<div class="container" style="font-family:Arial, sans-serif;">
    <h1 style="text-align:center;">Chat mit <?= htmlentities($this->partnerName); ?></h1>

    <div class="box" style="padding:20px; border-radius:12px; border:1px solid #ccc;">
        <!-- Feedback -->
        <?php $this->renderFeedbackMessages(); ?>

        <!-- Nachrichtenverlauf -->
        <div class="chat-box" style="border:1px solid #ccc; padding:10px; height:300px; overflow-y:auto; border-radius:10px;">
            <?php if (!empty($this->messages)) { ?>
                <?php foreach ($this->messages as $msg) { ?>
                    <div style="margin-bottom:10px; <?= $msg->sender_id == Session::get('user_id') ? 'text-align:right;' : ''; ?>">
                        <div style="display:inline-block; background:<?= $msg->sender_id == Session::get('user_id') ? '#dcf8c6' : '#f1f0f0'; ?>; padding:6px 10px; border-radius:10px;">
                            <strong><?= $msg->sender_id == Session::get('user_id') ? 'Du' : htmlentities($this->partnerName); ?>:</strong>
                            <?= nl2br(htmlentities($msg->message_text)); ?><br>
                            <small><?= htmlentities($msg->timestamp); ?></small>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Noch keine Nachrichten in diesem Chat.</p>
            <?php } ?>
        </div>

        <!-- Formular zum Senden -->
        <form method="post" action="<?= Config::get('URL'); ?>message/send" style="margin-top:15px; display:flex; gap:5px; align-items:flex-end;">
            <input type="hidden" name="receiver_id" value="<?= htmlentities($this->partnerId); ?>">
            <textarea name="message_text" rows="1" placeholder="Nachricht schreiben..." required style="flex:1; padding:6px 8px; border-radius:8px; border:1px solid #ccc; resize:none; height:36px;"></textarea>
            <input type="submit" value="➤" style="padding:0 12px; height:36px; border:none; border-radius:8px; background:#4CAF50; color:white; font-weight:bold; cursor:pointer;"/>
        </form>

    </div>
</div>