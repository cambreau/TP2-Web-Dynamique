<?php
//Étape 1 : Declarer une variable message qui contiendra un message d'avertissement en cas de retour d'erreur.
$msg = null;
if($_GET['msg'] == 1){
    $msg = "Veuillez vérifier le mot de passe.";
}
else if($_GET["msg"] == 2){
  $msg = "Veuillez vérifier le nom d'utilisateur.";}

//Étape 2 : Connexion à la base de données forumEtudiant.
require('BD/connexion.php');


//Étape 3 : Ajout de l'entete.
$titre="Connexion";
require('entete.php');
?>
        <h1>Se connecter</h1>
        <div>
          <form action="autorisation.php" method="post">
              <?= "<span class='erreur'>".$msg."</span>"; ?>
              <div>
              <label for="nom_utilisateur">Nom utilisateur</label>
                <input type="email" id="nom_utilisateur" name="nom_utilisateur" 
                placeholder="Saisir votre nom d'utilisateur" required>
              </div>
              <div>
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Saisir votre mot de passe" required>
              </div>
              <input type="submit" value="Se connecter" class="btn">
          </form>
          <a href="formulaire-utilisateur.php">Créer un compte</a>
      </div>
    <?php
  //Étape 4 : Ajout du pied de page.
   require('pied-page.php'); 
   ?>
