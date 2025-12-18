<div class="container">
    <h1>Nachrichten</h1>

    <div class="box">
        <!-- Feedback (Fehler oder Erfolg) -->
        <?php $this->renderFeedbackMessages(); ?>

        <h3>Deine Chats</h3>
        <p>Wähle eine Unterhaltung, um Nachrichten zu sehen oder zu schreiben.</p>

        <?php if (!empty($this->conversations)) { ?>
            <table class="note-table">
                <thead>
                    <tr>
                        <th>Partner</th>
                        <th>Letzte Nachricht</th>
                        <th>Ungelesen</th>
                        <th>Öffnen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->conversations as $chat): ?>
                        <tr>
                            <td>User #<?= $chat->partner_id ?></td>
                            <td><?= htmlentities($chat->last_message) ?></td>
                            <td>
                                <?php if ($chat->unread_count > 0): ?>
                                    <span class="badge red"><?= $chat->unread_count ?></span>
                                <?php endif; ?>
                            </td>
                            <td><a href="<?= Config::get('URL') . 'message/show/' . $chat->partner_id ?>">Chat öffnen</a></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        <?php } else { ?>
            <p>Du hast noch keine Nachrichten.</p>
        <?php } ?>
    </div>
</div>