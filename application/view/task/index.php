<div class="container">
    <h1>Kanban Board</h1>

    <div style="display: flex; gap: 15px;">

        <div class="box" style="flex: 1;">
            <h3>To Do</h3>
            <?php foreach ($this->tasks as $task) { 
                if ($task->status == 1) { ?>
                    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 5px;">
                        <?= htmlentities($task->text); ?>
                    </div>
            <?php } } ?>
        </div>

        <div class="box" style="flex: 1;">
            <h3>In Arbeit</h3>
            <?php foreach ($this->tasks as $task) { 
                if ($task->status == 2) { ?>
                    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 5px;">
                        <?= htmlentities($task->text); ?>
                    </div>
            <?php } } ?>
        </div>

        <div class="box" style="flex: 1;">
            <h3>Fertig</h3>
            <?php foreach ($this->tasks as $task) { 
                if ($task->status == 3) { ?>
                    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 5px;">
                        <?= htmlentities($task->text); ?>
                    </div>
            <?php } } ?>
        </div>

    </div>
</div>