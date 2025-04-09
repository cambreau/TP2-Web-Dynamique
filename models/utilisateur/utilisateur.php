<?php

/** Function qui verifie si l'utilisateur existe dans la base de donnees.
 * @param $connexion : la connexion a la base de donnees.   
 * @param $id_utilisateur : l'identifiant de l'utilisateur.
 * @return bool : vrai si l'utilisateur existe, faux sinon.
 */
 function utilisateur_existe($nom_utilisateur, $connexion):bool{   
    //Requête SQL.
    $requeteSQL = "SELECT * FROM utilisateur WHERE nom_utilisateur='$nom_utilisateur'";
    $resultat = mysqli_query($connexion, $requeteSQL);
    //Compter le nombre de lignes de $resultat.
    return mysqli_num_rows($resultat) > 0;
}

/** Fonction qui valide les champs du formulaire de création d'utilisateur.
 * @param $POST : les données du formulaire.
 * @return bool : $erreur faux si les champs sont valides, vrai s'il y a une erreur.
 */
function utilisateur_validation_champ($utilisateur, $connexion):bool{
    //Déclaration des variables.
    $erreur = false;
    //Declaration  des patterns de validation des champs. */
    $patterNomUtilisateur ="/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"; //Email
    $patternNom = "/^[a-zA-ZÀ-ÿ\s-]{2,25}$/"; //Lettre et espace, entre 2 et 25 caractères.
    $patternMotdePasse= '/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{6,20}$/'; //Au moins une lettre et un chiffre, entre 6 et 20 caractères.

    //Si les champs sont vides, afficher un message d'erreur.
    if(empty($utilisateur['nom_utilisateur']) || empty($utilisateur['nom']) || empty($utilisateur['mot_de_passe']) || empty($utilisateur['date_de_naissance']))
    {
      $erreur=true;     
    }else
    {
        //Validation des champs.
        if(!preg_match( $patterNomUtilisateur, $utilisateur['nom_utilisateur'])||!preg_match($patternNom, $utilisateur['nom'])||!preg_match($patternMotdePasse, $utilisateur['mot_de_passe']))
        {
          $erreur=true;
        }
    }  
    return $erreur;
}

/**
 * Fonction qui valide les données de l'utilisateur.
 * @param $POST
 * @return $msg string|null
 */
function utilisateur_validation($POST):string|null{
   //Connexion a la base de donnees forumEtudiant.
   require(CONNEX_DIR);
   //Déclaration des variables.
    $utilisateur =[];
    $msg = null;
   //Déclaration des variables.
   foreach($POST as $cle=>$valeur)
   {
       $utilisateur[$cle] = mysqli_real_escape_string($connexion, $valeur);
   }
   if(utilisateur_existe($utilisateur['nom_utilisateur'],$connexion))
   {
       $msg = "<p class='message erreur'>Le nom d'utilisateur existe déjà.</p>";
   }else if(utilisateur_validation_champ($utilisateur, $connexion))
   {
       $msg = "<div class='message erreur'>
          <p>Erreur lors de l'inscription.</p>
          <p>Veuillez respecter les régles suivantes:</p>
          <ul>
              <li>Tous les champs sont obligatoires</li>
              <li>Le nom d'utilisateur doit être une adresse email valide</li>
              <li>Le nom doit contenir entre 2 et 25 lettres</li>
              <li>Le mot de passe doit contenir des chiffres et des lettres entre 6 et 20 caractères</li>
              <li>La date de naissance doit être au format AAAA-MM-JJ</li> 
          </ul>
        </div>";
   }
   return $msg;
}

/**
 * Cette fonction permet de créer un utilisateur dans la base de données.
 * @param $connexion
 * @param $POST
 * @return array $resultat, $msg
 * $resultat : vrai si l'insertion a réussi, faux sinon.
 * $msg : message de succès ou d'erreur.
 */
function utilisateur_insertion($POST):array
{
    //Connexion a la base de donnees forumEtudiant.
    require(CONNEX_DIR);
    //Déclaration des variables.
    foreach($POST as $cle=>$valeur)
    {
        $$cle = mysqli_real_escape_string($connexion, $valeur);
    }
    //Hashage du mot de passe.
    $mot_de_passe=password_hash($mot_de_passe, PASSWORD_BCRYPT, ['cost' => 10]);
    //Requête SQL.
    $requeteSQL = "INSERT INTO Utilisateur (nom_utilisateur, nom, mot_de_passe, date_de_naissance)
    VALUES ('$nom_utilisateur' ,'$nom','$mot_de_passe','$date_de_naissance')";
    $resultat = mysqli_query($connexion, $requeteSQL);
    //Assignation du message de succès ou d'erreur.
    if($resultat)
    {
        $msg = "<p class='message succes'>Inscription réussie. Vous pouvez vous connecter.</p>";
    }else
    {
      $msg = "<p class='message erreur'>Erreur lors de l'inscription. Veuillez réessayer.</p>";
    }
    return ['resultat'=>$resultat, 'msg'=>$msg];
}

/**
 * Fonction qui permet de connecter l'utilisateur.
 * @param  $POST
 * @return string|null $msg
 */
function utilisateur_autorisation($POST): string|null  {
  //Connexion a la base de donnees forumEtudiant.
  require(CONNEX_DIR);
  //Session start.
  session_start();
  //Déclaration des variables.
  $msg = null; 
  //Valider si l'utilisateur existe dans la base de données.
  if(utilisateur_existe($POST['nom_utilisateur'], $connexion))
  {
      //Requête SQL.
      $requeteSQL = "SELECT * FROM utilisateur WHERE nom_utilisateur='$POST[nom_utilisateur]'";
      $resultat = mysqli_query($connexion, $requeteSQL);
      //Récupérer les données de l'utilisateur.
      $utilisateur = mysqli_fetch_all($resultat, MYSQLI_ASSOC);
      //Vérifier le mot de passe.
      if(password_verify($POST['mot_de_passe'], $utilisateur['mot_de_passe']))
      {
          $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
          $_SESSION['nom_utilisateur'] = $utilisateur['nom_utilisateur'];
          $_SESSION['nom'] = $utilisateur['nom'];
      }else
      {
        $msg= "<p class='message erreur'>Le mot de passe est incorrect.</p>";
      }
  }else
  {
      $msg= "<p class='message erreur'>Le nom d'utilisateur n'existe pas.</p>";
  }
  return $msg;
}
?>
