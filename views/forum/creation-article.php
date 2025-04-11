<h1>Nouvel article</h1>
<section>
    <?php print_r($donnee) ?>
    <?=$donnee?>
    <form action="?controller=forum&function=creation" method="post">
    <div>
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre" placeholder="Entrez le titre" maxlength="100" required>
    </div>
    <div>
        <label for="article">Article</label>
        <textarea id="article" name="article" rows="10" cols="40" required placeholder="Entrez votre article"></textarea>
    </div>
    <input type="submit" value="Créer" class="btn">
</form>
</section>