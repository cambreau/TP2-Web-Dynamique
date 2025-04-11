<h1>Bienvenue <?= $_SESSION['nom']?> </h1>
<a class="btn" href="?controller=forum&function=pageCreation">Ajouter un article</a>
<section>
    <h2>Vos articles</h2>
    <?php
    if(empty($donnee['articles'])){
    ?>
        <p class="message information">Vous n'avez pas encore d'articles.</p>
    <?php 
    }
    echo isset($donnee['msg'])?$donnee['msg']:null;
    foreach($donnee['articles'] as $article)
    {
    ?>
        <article class="article-forum">
            <h3><?=$article['titre']?></h3>
            <p><strong>Publié le :</strong> <?=$article['date_publication']?></p>
            <p><strong>Par :</strong> <?=$article['nom']?></p>
            <p><?=$article['article']?></p>
            <div class="conteneur-btn">
                <a class="btn petit" href="?controller=forum&function=pageModification&id=<?= $article['id_Forum']?>">Modifier</a>
                <a class="btn petit" href="?controller=forum&function=supprimer&id=<?= $article['id_Forum']?>">Supprimer</a>
            </div>
        </article>
    <?php
    }
    ?>
</section>