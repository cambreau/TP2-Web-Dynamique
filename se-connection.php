<?php
//Étape 1 : Declarer une variable message qui contiendra un message d'avertissement en cas de retour d'erreur.
$msg = null;
if(isset($_GET['msg'])){
    $msg = "Veuillez vérifier le nom d'utilisateur.";
}

//Étape 2 : Connexion à la base de données forumEtudiant.
require('BD/connexion.php');


//Étape 3 : Ajout de l'entete.
require('entete.php');
?>
    <main>
        <h1>Se connecter</h1>
        <form action="autorisation.php" method="post">
            <?= "<span class='erreur'>".$msg."</span>"; ?>
            <label for="nom_utilisateur">Nom utilisateur</label>
            <input type="email" id="nom_utilisateur" name="nom_utilisateur">
            <label for="mot_de_passe">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe">
            <input type="submit" value="Se connecter" class="btn">
        </form>
    </main>
    <?php
  //Étape 4 : Ajout du pied de page.
   require('pied-page.php'); ?>
</body>
