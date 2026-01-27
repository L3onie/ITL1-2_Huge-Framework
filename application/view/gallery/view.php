<div class="container" style="text-align:center;">
    <h2>Bildanzeige</h2>
    <img src="<?= Config::get('URL'); ?>gallery/show/<?= $this->img->id; ?>" 
         style="max-width:90%; height:auto; border:1px solid #ccc; margin:20px 0;">
    <br>
    <a href="<?= Config::get('URL'); ?>gallery">Zurück zur Galerie</a>
</div>
