<?php
 function article_affichage(){
    // Connexion à la base de données.
    require(CONNEX_DIR);
    //Requête SQL.
    $requeteSQL = "SELECT forum.*, nom_utilisateur 
    FROM forum
    INNER JOIN utilisateur ON forum.id_utilisateur = utilisateur.id_utilisateur
    ORDER BY date_publication DESC;";
    $resultat = mysqli_query($connexion, $requeteSQL);
    $resultat = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
    return $resultat;
}

?>