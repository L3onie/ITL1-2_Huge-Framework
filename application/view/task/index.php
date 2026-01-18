<div class="container">
    <h1>Kanban Board - Schritt 3 (Funktionen)</h1>

    <div class="box">
        <a href="<?= Config::get('URL'); ?>task/create" class="login-button" style="text-decoration: none;">+ Neue Aufgabe erstellen</a>
    </div>

    <div style="display: flex; gap: 15px;">

        <div class="box" style="flex: 1;">
            <h3>To Do</h3>
            <?php foreach ($this->tasks as $task) { if ($task->status == 1) { ?>
                <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 5px;">
                    <p><?= htmlentities($task->text); ?></p>
                    <hr>
                    <div style="display: flex; justify-content: space-between;">
                        <span></span> 
                        <div>
                            <a href="<?= Config::get('URL') . 'task/edit/' . $task->id; ?>">✎</a>
                            <a href="<?= Config::get('URL') . 'task/delete/' . $task->id; ?>">✖</a>
                        </div>
                        <a href="<?= Config::get('URL') . 'task/updateStatus/' . $task->id . '/2'; ?>">▶</a>
                    </div>
                </div>
            <?php } } ?>
        </div>

        <div class="box" style="flex: 1;">
            <h3>In Arbeit</h3>
            <?php foreach ($this->tasks as $task) { if ($task->status == 2) { ?>
                <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 5px;">
                    <p><?= htmlentities($task->text); ?></p>
                    <hr>
                    <div style="display: flex; justify-content: space-between;">
                        <a href="<?= Config::get('URL') . 'task/updateStatus/' . $task->id . '/1'; ?>">◀</a>
                        <div>
                            <a href="<?= Config::get('URL') . 'task/edit/' . $task->id; ?>">✎</a>
                            <a href="<?= Config::get('URL') . 'task/delete/' . $task->id; ?>">✖</a>
                        </div>
                        <a href="<?= Config::get('URL') . 'task/updateStatus/' . $task->id . '/3'; ?>">▶</a>
                    </div>
                </div>
            <?php } } ?>
        </div>

        <div class="box" style="flex: 1;">
            <h3>Fertig</h3>
            <?php foreach ($this->tasks as $task) { if ($task->status == 3) { ?>
                <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 5px;">
                    <p><?= htmlentities($task->text); ?></p>
                    <hr>
                    <div style="display: flex; justify-content: space-between;">
                        <a href="<?= Config::get('URL') . 'task/updateStatus/' . $task->id . '/2'; ?>">◀</a>
                        <div>
                            <a href="<?= Config::get('URL') . 'task/edit/' . $task->id; ?>">✎</a>
                            <a href="<?= Config::get('URL') . 'task/delete/' . $task->id; ?>">✖</a>
                        </div>
                        <span></span> 
                    </div>
                </div>
            <?php } } ?>
        </div>

    </div>
</div>