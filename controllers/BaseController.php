<?php

function base_controller_index(){
    require_once(MODEL_DIR."/forum/forum.php");
    $articles = article_affichage();
    // Affiche la page d'accueil du forum
    render('forum/accueil.php', $articles);
 }
?>