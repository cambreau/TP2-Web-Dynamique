<?php
//Étape 1 : Connexion a la base de donnees forumEtudiant.
require('connexion.php');

//Étape 2 : Déclaration des variables.
$patterNomUtilisateur ="/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"; //Email
$patternNom = "/^[a-zA-ZÀ-ÿ\s-]{2,25}$/"; //Lettre et espace, entre 2 et 25 caractères.
$patternMotdePasse= '/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{6,20}$/'; //Au moins une lettre et un chiffre, entre 6 et 20 caractères.
$patternDateNaissance = "/^(\d{4})-(\d{2})-(\d{2})$/"; //Date de naissance au format AAAA-MM-JJ.
$erreurValidationChamp=false;

//Étape 3 : Récupérer les variables du formulaire.
$nom_utilisateur = isset($_POST['nom_utilisateur'])?mysqli_real_escape_string($connexion, $_POST['nom_utilisateur']):"";
$nom= isset($_POST['nom'])?mysqli_real_escape_string($connexion, $_POST['nom']):"";
$mot_de_passe= isset($_POST['mot_de_passe'])?mysqli_real_escape_string($connexion, $_POST['mot_de_passe']):"";
$date_de_naissance = isset($_POST['date_de_naissance'])?mysqli_real_escape_string($connexion, $_POST['date_de_naissance']):"";
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nouvel utilisateur</title>
  </head>
  <body>
    <nav>
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="formulaire-creation-utilisateur.php">Création utilisateur</a></li>
        <li><a href="">Connexion</a></li>
        <li><a href="">Création Article</a></li>
      </ul>
    </nav>
    <main>
      <h1>Création utilisateur</h1>
      <form action="formulaire-utilisateur.php" method="post">
        <label for="nom_utilisateur">Nom utilisateur</label>
        <input type="email" id="nom_utilisateur" name="nom_utilisateur" value="<?=$nom_utilisateur?>" required />
        <label for="nom">Nom et prénom</label>
        <input type="text" id="nom" name="nom" value="<?=$nom?>" required />
        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" value="<?=$mot_de_passe?>" required />
        <label for="date_de_naissance">Date de naissance</label>
        <input type="date" id="date_de_naissance" name="date_de_naissance" value="<?=$date_de_naissance?>" required />
        <input type="submit" name="boutonEnvoie" value="Enregistrer" />
      </form>
    </main>
  </body>
</html>

<?php
if(isset($_POST["boutonEnvoie"]))
{
  //Étape 4 : Valider les variables.
  if(isset($_POST["nom_utilisateur"]) && isset($_POST["nom"]) && isset($_POST["mot_de_passe"]) && isset($_POST["date_de_naissance"]))
  { 
    //Si vrai: Si la méthode de requête n'est pas POST, rediriger vers la page du formulaire de redirection.
    if($_SERVER['REQUEST_METHOD'] != "POST")
    {
      header('location:formulaire-creation-utilisateur.php');
      die();
    }
    else{
      //Vérifier si l'utilisateur existe déjà.
      $requeteSQL = "SELECT * FROM Utilisateur WHERE nom_utilisateur = '$nom_utilisateur'";
      $resultat = mysqli_query($connexion, $requeteSQL);
      $compteurLigne = mysqli_num_rows($resultat);
      //Si l'utilisateur existe déjà, afficher un message d'erreur.
      if($compteurLigne > 0)
      {
        ?>
            <p class=erreur>L'utilisateur <?=$nom_utilisateur?> existe déjà.</p>
        <?php
        die();
      }
      //Sinon on valide que les champs respectent les règles des formulaires.
      else
      {
        if(!preg_match( $patterNomUtilisateur, $nom_utilisateur))
        {
          ?>
            <p class=erreur>Le nom d'utilisateur doit être une adresse email valide</p>
          <?php
          $erreurValidationChamp=true;
        }
        if(!preg_match($patternNom, $nom))
        {
          ?>
            <p class=erreur>Le nom doit contenir entre 2 et 25 lettres</p>
          <?php
          $erreurValidationChamp=true;
        }
        if(!preg_match($patternMotdePasse, $mot_de_passe))
        {
          ?>
            <p class=erreur>Le mot de passe doit contenir des chiffre et des lettres entre 6 et 25 caractères</p>
          <?php
          $erreurValidationChamp=true;
        }
        if(!preg_match($patternDateNaissance, $date_de_naissance))
        {
          ?>
          <p class=erreur>Le format de la date doit être AAAA-MM-JJ</p>
        <?php
        $erreurValidationChamp=true;
        }
      }
    }
  }
  else
  { //Si faux: afficher un message d'erreur.
    ?>
      <p class=erreur>Les champs ne sont pas remplis</p>
    <?php
  }
      
  if(!$erreurValidationChamp && preg_match($patterNomUtilisateur,$nom_utilisateur) && preg_match($patternNom, $nom) && preg_match($patternMotdePasse, $mot_de_passe) && preg_match($patternDateNaissance, $date_de_naissance))
  {
    //Étape 5 : Si le mot de passe respecte le pattern, on le sécurise avec la fonction password_hash.
    //PASSWORD_BCRYPT recommandé en cours.
    $mot_de_passe = password_hash($mot_de_passe, PASSWORD_BCRYPT, ['cost' => 10]);;

    //Étape 6 : Créer un nouvel utilisateur.
    $requeteSQL = "INSERT INTO Utilisateur (nom_utilisateur, nom, mot_de_passe, date_de_naissance)
    VALUES ('$nom_utilisateur' ,'$nom','$mot_de_passe','$date_de_naissance')";

    //Étape 7 : Si la requête est exécutée afficher un message de succès.
    if(mysqli_query($connexion, $requeteSQL))
    {
      ?>
      <p class=succes>L'utilisateur a été créé avec succès.</p>
    <?php
    }
    else
    { //Sinon afficher un message d'erreur.
      echo "Error ".mysqli_error($connex);
    }
  }
  else{
  // Code de validation:
  //  $estValideNomUtilisateur=preg_match($patterNomUtilisateur,$nom_utilisateur);
  //  echo "$estValideNomUtilisateur.<br>";
  //  $estValideNom=preg_match($patternNom, $nom);
  //  echo "$estValideNom.<br>"; 
  //  $estValideMotPasse=preg_match($patternMotdePasse, $mot_de_passe);
  //  echo "$estValideMotPasse.<br>";
  //  $estValideDateNaissance=preg_match($patternDateNaissance, $date_de_naissance);
  //  echo "$estValideDateNaissance.<br>";
  }
}
?>