<div class="container">
    <h1>Task bearbeiten</h1>

    <div class="box" style="background: #ebecf0; border-radius: 5px; padding: 20px;">
        <form action="<?= Config::get('URL'); ?>task/updateSave" method="post" style="background: white; padding: 20px; border-radius: 3px; box-shadow: 0 1px 3px rgba(0,0,0,0.12); border-left: 5px solid #444445;">
            
            <input type="hidden" name="task_id" value="<?= htmlentities($this->task->id); ?>" />

            <label style="display: block; margin-bottom: 10px; font-weight: 500; color: #444445;">Task bearbeiten:</label>
            
            <input type="text" name="task_text" value="<?= htmlentities($this->task->text); ?>" required autofocus 
                   style="width: 100%; box-sizing: border-box; padding: 12px; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 20px; font-size: 1rem;" />
            
            <div style="display: flex; gap: 15px; align-items: center;">
                <button type="submit" class="login-button" style="margin: 0; padding: 10px 20px;">Speichern</button>
                <a href="<?= Config::get('URL'); ?>task/index" style="text-decoration: none; color: #6b778c; font-weight: 500;">Abbrechen</a>
            </div>
        </form>
    </div>
</div>