   <h1>Bienvenue dans le forum etudiant</h1>
    <?= isset($donnee['msg'])?$donnee['msg']:null; ?>
<section>
    <h2>Tous les articles du forum</h2>
    <?php
    foreach($donnee as $article)
    {
    ?>
        <article class="article-forum">
            <h3><?=$article['titre']?></h3>
            <p><strong>Publié le :</strong> <?=$article['date_publication']?></p>
            <p><strong>Par :</strong> <?=$article['nom']?></p>
            <p><?=$article['article']?></p>
            <?php
            //Si la session existe et que l'auteur de l'article est l'utilisateur alors affiche les boutons modifier et supprimer.
            if (isset($_SESSION['id_utilisateur'])) {
                if($_SESSION['id_utilisateur'] == $article['id_utilisateur']) 
                {
                ?>
                <div class="conteneur-btn">
                    <a class="btn petit" href="?controller=forum&function=pageModification&id=<?= $article['id_Forum']?>">Modifier</a>
                    <a class="btn petit" href="?controller=forum&function=supprimer&id=<?= $article['id_Forum']?>">Supprimer</a>
                </div>
                <?php
                }
            }
                ?>
            </article>
            <?php
    }
            ?>
</section>
