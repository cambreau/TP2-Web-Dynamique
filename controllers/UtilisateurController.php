<?php 
function utilisateur_controller_pageCreation(){
 render(fichier: 'utilisateur/creation.php');
}

function utilisateur_controller_creer($POST){
    //Valider que les donnees parviennent par la methode POST.
    if($_SERVER['REQUEST_METHOD'] != "POST")
    {
        $msg="<p class='message erreur'>Une erreur s'est produite lors de l'inscription. Veuillez réessayer.</p>"; 
        render(fichier: "utilisateur/creation.php", donnee: ['msg'=>$msg]);
    }
    //Valider que les champs soient bons
    else
    {
        //Inclure le modèle utilisateur
        require_once(MODEL_DIR."/utilisateur/utilisateur.php"); 
        $msg = utilisateur_validation($POST);
        if($msg)
        {
            // Si le message d'erreur n'est pas vide, afficher le message d'erreur
            render(fichier: "utilisateur/creation.php", donnee: ['msg'=>$msg]);
        }else
        {
            // Si le message d'erreur est vide, procéder à l'insertion de l'utilisateur
          $resultatInsertion = utilisateur_insertion($POST);
          if($resultatInsertion['resultat'])
          {
            // Si l'insertion réussie, rediriger vers la page de connexion
            render(fichier: "utilisateur/se-connecter.php", donnee: [
                'msg' => "<p class='message succes'>Inscription réussie. Vous pouvez vous connecter.</p>"
            ]);
          }else
          {
            // Si l'insertion échoue, afficher un message d'erreur
            render(fichier: "utilisateur/creation.php", donnee: [
                'msg' => "<p class='message erreur'>Erreur lors de l'inscription. Veuillez réessayer.</p>"
            ]);
          }
        }
    }
}

function utilisateur_controller_pageConnexion(){
    render(fichier: 'utilisateur/se-connecter.php');
}

function utilisateur_controller_connexion($POST){
    //Valider que les donnees parviennent par la methode POST.
    if($_SERVER['REQUEST_METHOD'] != "POST")
    {
         $msg="<p class='message erreur' Une erreur s'est produite lors de la connexion.</p>"; 
         render(fichier: "utilisateur/se-connecter.php", donnee: ['msg'=>$msg]);
    }else
    {  
        //Inclure le modèle utilisateur
        require_once(MODEL_DIR."/utilisateur/utilisateur.php");
        //Declaration des variables.
        $msg = null;  
        $msg = utilisateur_connexion($POST);
        //Valider que l'utilisateur existe dans la base de données.
        if($msg)
        {
            // Si le message d'erreur n'est pas vide, afficher le message d'erreur
            render(fichier: "utilisateur/se-connecter.php", donnee: ['msg'=>$msg]);
        }else
        {
            // Si le message d'erreur est vide, rediriger vers la page d'accueil
            require_once("ForumController.php");
            forum_controller_mesArticles();
        }
    }
}

function utilisateur_controller_deconnexion(){
    //Inclure le modèle utilisateur
    require_once(MODEL_DIR."/utilisateur/utilisateur.php");
    //Déconnexion de l'utilisateur
    utilisateur_deconnexion();
    //Redirection vers la page d'accueil
    require_once("BaseController.php");
    base_controller_index();
}
?>