<?php
 /**
  * Fonction qui retourne tous les articles de la base de données.
  * @return array d'articles
  */
 function article_affichage(){
    // Connexion à la base de données.
    require(CONNEX_DIR);
    //Requête SQL.
    $requeteSQL = "SELECT forum.*, nom 
    FROM forum
    INNER JOIN utilisateur ON forum.id_utilisateur = utilisateur.id_utilisateur
    ORDER BY date_publication DESC;";
    $resultat = mysqli_query($connexion, $requeteSQL);
    $resultat = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
    return $resultat;
}

/**
 * Fonction qui retourne tous les articles de la base de données de l'utilisateur connecté.
 * @return array d'articles
 */
function article_mesArticles(){
    // Connexion à la base de données.
    require(CONNEX_DIR);
    //Requête SQL.
    $requeteSQL = "SELECT forum.*, nom 
    FROM forum
    INNER JOIN utilisateur ON forum.id_utilisateur = utilisateur.id_utilisateur
    WHERE forum.id_utilisateur = '$_SESSION[id_utilisateur]'
    ORDER BY date_publication DESC;";
    $resultat = mysqli_query($connexion, $requeteSQL);
    $resultat = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
    return $resultat;
}

function article_creer($POST){
    // Connexion à la base de données.
    require(CONNEX_DIR);
    //Déclaration des variables.
    foreach($POST as $cle=>$valeur)
    {
        $$cle = mysqli_real_escape_string($connexion, $valeur);
    }
    $date_publication = date('Y-m-d');
    $id_utilisateur=$_SESSION['id_utilisateur'] ;
     //Requête SQL.
     $requeteSQL = "INSERT INTO forum (titre, article, date_publication, id_utilisateur) 
                   VALUES ('$titre', '$article', '$date_publication', '$id_utilisateur')";
     $resultat = mysqli_query($connexion, $requeteSQL);
     return $resultat; 
}

/**
 * Fonction qui recupere l'article à modifier.
 * @param $articleId 
 * @return array des informations de l'article à modifier.
 */
function article_affichage_pageModification($articleId){
     // Connexion à la base de données.
     require(CONNEX_DIR);
     //Requête SQL.
     $requeteSQL = "SELECT * FROM forum WHERE id_forum='$articleId'";;
     $resultat = mysqli_query($connexion, $requeteSQL);
     $resultat = mysqli_fetch_array($resultat, MYSQLI_ASSOC);
     return $resultat;
}

/**
 * Fonction qui envoie les modifications de l'article à la base de données.
 * @param $POST Les informations de l'article
 * @param $id Numero de l'article
 * @return bool True si la modification a fonctionnée. False, si c'est en echec.
 */
function article_modifier($POST){
    // Connexion à la base de données.
    require(CONNEX_DIR);
    //Déclaration des variables.
    foreach($POST as $cle=>$valeur)
    {
        $$cle = mysqli_real_escape_string($connexion, $valeur);
    }
    $date_publication = date('Y-m-d');
    //Requête SQL.
    $requeteSQL = "UPDATE forum SET titre='$titre', article='$article', date_publication='$date_publication' WHERE id_Forum='$id_Forum';";
    $resultat = mysqli_query($connexion, $requeteSQL);
    return $resultat; 
}

/**
 * Fonction qui gere la suppression d'un article.
 * @param $id Numero de l'article
 * @return bool True si la suppression a fonctionnée. False, si c'est en echec.
 */
function article_supprimer($id):bool{
     // Connexion à la base de données.
     require(CONNEX_DIR);
       //Requête SQL.
    $requeteSQL = "DELETE FROM forum WHERE id_Forum='$id'";
    $resultat = mysqli_query($connexion, $requeteSQL);
    return $resultat;
}
?>