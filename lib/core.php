<?php

/**
 * Fonction qui protége les données en échappant certains caractères potentiellement dangereux.
 * @param  $param
 * @return string
 */
function safe($param){
    return addslashes($param);
}

/**
 * Fonction qui prépare une vue à afficher dans une mise en page et retourne le contenu HTML final.
 * @param $fichier
 * @param $donnee Grâce à $donnee, ces données peuvent être utilisées dans la vue, pour être affichées.
 * @return $contenu : string
 */
function render($fichier, $donnee = null){
    $miseEnPage_fichier = VIEW_DIR."/mise-en-forme/mise_en_forme.php";
    ob_start(); //Capturer tout ce qui s'affiche à l'écran (HTML) au lieu de l’envoyer directement au navigateur.
    include_once(VIEW_DIR."/".$fichier);
    $contenu = ob_get_clean(); //Récupérer tout le contenu en une seule chaine.
    include_once($miseEnPage_fichier);
    return $contenu; //Retourner le contenu de la page.
}
?>