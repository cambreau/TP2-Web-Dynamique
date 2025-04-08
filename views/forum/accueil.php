

    <h1>Bienvenue dans le forum etudiant</h1>
    <section>
   <?php
    foreach($donnee as $article){
    ?>
        <article class="article-forum">
            <h2><?=$article['titre']?></h2>
            <p><strong>Publié le :</strong> <?=$article['date_publication']?></p>
            <p><strong>Par :</strong> <?=$article['nom_utilisateur']?></p>
            <p></p><?=$article['article']?></p>
        </article>
    <?php
    }
    ?>
    </section>
