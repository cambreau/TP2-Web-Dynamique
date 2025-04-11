<h1>Modifier l'article <?=$donnee['article']['titre']?></h1>
<form action="?controller=forum&function=modifier&id=<?=$donnee['article']['id_Forum']?>" method="post">
    <div>
        <label for="id_Forum">ID article</label>
        <input type="text" id="id_Forum" name="id_Forum" value="<?=$donnee['article']['id_Forum']?>" readonly>
    </div>
    <div>
        <label for="date_publication">Date de publication</label>
        <input type="date" id="date_publication" name="date_publication" value="<?=$donnee['article']['date_publication']?>" readonly>
    </div>
    <div>
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre" value="<?=$donnee['article']['titre']?>" required>
    </div>
    <div>
        <label for="article">Article</label>
        <textarea id="article" name="article" rows="10" cols="40" required><?=$donnee['article']['article']?></textarea>
    </div>
    <input type="submit" value="Enregistrer" class="btn">
</form>