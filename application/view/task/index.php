<div class="container">
    <h1>Kanban Board</h1>

    <div class="box" style="background: #ebecf0; border-radius: 5px; padding: 10px; margin-bottom: 20px;">
        <a href="<?= Config::get('URL'); ?>task/create"
            style="display: block; box-sizing: border-box; width: 100%; padding: 12px; background: white; text-decoration: none; text-align: center; font-weight: 500; border-radius: 3px; color: #444445; border: 1px solid #ccc;">
            ✚ Neue Karte hinzufügen
        </a>
    </div>

    <div style="display: flex; gap: 15px; align-items: flex-start;">

        <?php
        $columns = [
            1 => ['title' => '📌 To Do', 'color' => '#cf023c'],
            2 => ['title' => '⚡ In Arbeit', 'color' => '#f4df00'],
            3 => ['title' => '✅ Fertig', 'color' => '#48da78']
        ];

        foreach ($columns as $status_id => $info): ?>
            <div class="box" style="flex: 1; background: #ebecf0; border-radius: 5px; padding: 10px;">
                <h3 style="margin-bottom: 15px; color: #444445;"><?= $info['title'] ?></h3>

                <?php foreach ($this->tasks as $task): ?>
                    <?php if ($task->status == $status_id): ?>
                        <div style="background: white; padding: 12px; margin-bottom: 10px; border-radius: 3px; box-shadow: 0 1px 3px rgba(0,0,0,0.12); border-left: 5px solid <?= $info['color'] ?>;">

                            <p style="margin-bottom: 15px; font-weight: 500; color: #444445;">
                                <?= htmlentities($task->text); ?>
                            </p>

                            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 12px;">

                                <?php if ($task->status > 1): ?>
                                    <a href="<?= Config::get('URL') . 'task/updateStatus/' . $task->id . '/' . ($task->status - 1); ?>"
                                        style="text-decoration: none; color: #6b778c; font-size: 1.1rem;">◀</a>
                                <?php else: ?>
                                    <span></span>
                                <?php endif; ?>

                                <div style="display: flex; gap: 20px; font-size: 1.2rem;">
                                    <a href="<?= Config::get('URL') . 'task/update/' . $task->id; ?>" title="Bearbeiten"
                                        style="text-decoration: none;">✎</a>
                                    
                                    <a href="javascript:void(0);" 
                                       title="Löschen (Doppelklick)" 
                                       ondblclick="window.location.href='<?= Config::get('URL') . 'task/delete/' . $task->id; ?>'"
                                       style="text-decoration: none; color: #eb5757; cursor: pointer; user-select: none;">✖</a>
                                </div>

                                <?php if ($task->status < 3): ?>
                                    <a href="<?= Config::get('URL') . 'task/updateStatus/' . $task->id . '/' . ($task->status + 1); ?>"
                                        style="text-decoration: none; color: #6b778c; font-size: 1.1rem;">▶</a>
                                <?php else: ?>
                                    <span></span>
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

    </div>
</div>