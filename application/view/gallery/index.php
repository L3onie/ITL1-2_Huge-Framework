<div class="container" style="padding: 20px; max-width: 1000px; margin: auto; font-family: sans-serif;">

    <h1 style="text-align:center;">Meine Galerie</h1>

    <form action="<?= Config::get('URL'); ?>gallery/upload" method="post" enctype="multipart/form-data" style="text-align:center; margin-bottom: 30px;">
        <input type="file" name="image" required>
        <button type="submit">Hochladen</button>
    </form>

    <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
        <?php foreach ($this->images as $img): ?>
            <div style="text-align: center;">
                <a href="<?= Config::get('URL'); ?>gallery/view/<?= $img->id; ?>">
                    <img src="<?= Config::get('URL'); ?>gallery/show/<?= $img->id; ?>" style="width: 200px; height: 200px; object-fit: cover; border-radius: 6px; border: 1px solid #ccc;">
                </a>

                <div style="margin-top: 8px; font-size: 0.9em;">
                    <a href="<?= Config::get('URL'); ?>gallery/download/<?= $img->id; ?>" style="text-decoration: none; color: black;">Download</a>
                    <span style="color: #aaaaaa;"> | </span>
                    <a href="javascript:copyLink(<?= $img->id; ?>)" style="text-decoration: none; color: black;">Share</a>
                    <span id="ok-<?= $img->id; ?>" style="display: none;"> (Kopiert!)</span>
                    <br>
                    <a href="<?= Config::get('URL'); ?>gallery/delete/<?= $img->id; ?>" style="text-decoration: none; color: black;" onclick="return confirm('Löschen?')">Löschen</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function copyLink(id) {
        fetch('<?= Config::get("URL"); ?>gallery/share/' + id)
            .then(res => res.text())
            .then(link => {
                navigator.clipboard.writeText(link).then(() => {
                    const status = document.getElementById('ok-' + id);
                    status.style.display = 'inline';
                    setTimeout(() => { status.style.display = 'none'; }, 2000);
                });
            });
    }
</script>