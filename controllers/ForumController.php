<?php 
 function forum_controller_mesArticles($param=null){
    //Inclure le modèle forum.
    require_once(MODEL_DIR."/forum/forum.php");
    //Récupérer les articles du forum de l'utilisateur connecté.
    $articles = article_mesArticles();
    //Si $param est un array, alors cela veut dire que l'utilisateur arrive sur la page avec des $_GET.
    //Donc on ne veut pas que les params soient envoyés avec le render.
    if(is_array($param)) {
      render(fichier: 'forum/mes-articles.php', donnee: ['articles'=>$articles]);
    }
    else {
    //Sinon, cela veut dire qu'il s'agit du message envoyé lors de la modification, suppression ou creation.
    render(fichier: 'forum/mes-articles.php', donnee: ['articles'=>$articles,'msg'=>$param]);
   }
}

 function forum_controller_pageCreation($param=null){
   //Si $param est un array, alors cela veut dire que l'utilisateur arrive sur la page avec des $_GET.
   //Donc on ne veut pas que les params soient envoyés avec le render.
   if(is_array($param)) {
      render(fichier: 'forum/creation-article.php');
    }
    else {
    //Sinon, cela veut dire qu'il s'agit du message envoyé pour indiquer une erreur de creation.
    render(fichier: 'forum/creation-article.php', donnee: ['msg'=>$param]);
   }
 }

 function forum_controller_creation(): void{
    //Inclure le modèle forum.
    require_once(MODEL_DIR."/forum/forum.php");
    //Créer l'article
    $resultat=article_creer($_POST);
    if($resultat)
    {
      $msg='<p class="message succes">Création réussie</p>';
      forum_controller_mesArticles($msg);
    }else{
      $msg= '<p class="message erreur">Erreur lors de la création</p>';
      forum_controller_pageCreation($msg);
    }
   }


 function forum_controller_pageModification(){
    //Inclure le modèle forum.
    require_once(MODEL_DIR."/forum/forum.php");
    //Déclaration des variables.
    $articleId=$_GET['id'];
    //Récupérer l'article à modifier.
    $article=article_affichage_pageModification( $articleId );
    //Afficher la vue de modification de l'article
    render(fichier: 'forum/modifier.php', donnee: ['article'=>$article]);
 }

 function forum_controller_modifier(){
   //Inclure le modèle forum
   require_once(MODEL_DIR."/forum/forum.php");
  //Traitement du formulaire de modification d'article.
    if(article_modifier(POST: $_POST)){
      $msg='<p class="message succes">Modification réussie</p>';
      forum_controller_mesArticles( $msg);
    }else{
      $msg='<p class="message erreur">Erreur lors de la modification.</p>';
      render(fichier: 'forum/modifier.php', donnee: ['msg'=>$msg, 'article'=>$_POST]);
    }
 }

 function forum_controller_supprimer(){
   //Inclure le modèle forum.
   require_once(MODEL_DIR."/forum/forum.php");
   //Déclaration des variables.
   $articleId=$_GET['id'];
   //Traitement du la demande de suppression d'article.
   $msg=article_supprimer($articleId)?'<p class="message succes">Suppression réussie</p>':'<p class="message erreur">Erreur lors de la suppression.</p>';
   forum_controller_mesArticles( $msg);
 }
?>