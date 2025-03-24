<?php
//Étape 1 : Connexion à la base de données forumEtudiant.
require('BD/connexion.php');

//Étape 2 : Récupérer les articles.
$requeteSQL = "SELECT * FROM forum ORDER BY date_publication DESC";
$resultat = mysqli_query($connexion, $requeteSQL);
$articles  = mysqli_fetch_all($resultat, MYSQLI_ASSOC);

//Étape 2 : Ajout de l'entete.
require('entete.php');
?>
    <main>
        <h1>Forum Etudiant</h1>
        <form action="ajouter-article.php" method="post">
                        <input type="submit" value="Ajouter" class="btn">
        </form>
        <section>
            <?php
                //Afficher les articles.
                foreach($articles as $article){
            ?>
            <article>
                <div>
                    <form action="modifier-article.php" method="post">
                        <input type="hidden" name="id" value="<?= $article['identification'];?>">
                        <input type="submit" value="Modifier" class="btn">
                    </form>
                    <form action="supprimer-article.php" method="post">
                        <input type="hidden" name="id" value="<?= $article['identification'];?>">
                        <input type="submit" value="Supprimer" class="btn">
                    </form>
                </div>
                <section>
                    <h2><?=$article['titre']?></h2>
                    <div class="article-metadonnees">
                        <p><?=$article['nom_utilistateur']?></p>
                        <p><?=$article['date_publication']?></p>
                    </div>
                    <p><?=$article['article']?></p>
                </section>
            </article>
            <?php
        }
        ?>
        </section>
    </main>
    <?php
  //Étape 3 : Ajout du pied de page.
   require('pied-page.php'); ?>