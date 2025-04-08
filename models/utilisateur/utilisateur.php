<?php


/** Function qui verifie si l'utilisateur existe dans la base de donnees.
 * @param $connexion : la connexion a la base de donnees.   
 * @param $id_utilisateur : l'identifiant de l'utilisateur.
 * @return bool : vrai si l'utilisateur existe, faux sinon.
 */
 function utilisateur_existe($nom_utilisateur):bool
{   
    //Connexion a la base de donnees forumEtudiant.
    require(CONNEX_DIR);
    //Requête SQL.
    $requeteSQL = "SELECT * FROM utilisateur WHERE nom_utilisateur='$nom_utilisateur'";
    $resultat = mysqli_query($connexion, $requeteSQL);
    //Compter le nombre de lignes de $resultat.
    return mysqli_num_rows($resultat) > 0;
}

/** Fonction qui valide les champs du formulaire de création d'utilisateur.
 * @param $POST : les données du formulaire.
 * @return bool : vrai si les champs sont valides, faux sinon.
 */
function utilisateur_validation_champ($POST):bool
{
    //Connexion a la base de donnees forumEtudiant.
    require(CONNEX_DIR);
    //Déclaration des variables.
    $erreur = false;
    foreach($POST as $cle=>$valeur){
        $$cle = mysqli_real_escape_string($connexion, $valeur);
    }
    // Declaration  des patterns de validation des champs. */
    $patterNomUtilisateur ="/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/"; //Email
    $patternNom = "/^[a-zA-ZÀ-ÿ\s-]{2,25}$/"; //Lettre et espace, entre 2 et 25 caractères.
    $patternMotdePasse= '/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{6,20}$/'; //Au moins une lettre et un chiffre, entre 6 et 20 caractères.

    //Si les champs sont vides, afficher un message d'erreur.
    if(empty($POST['nom_utilisateur']) || empty($POST['nom']) || empty($POST['mot_de_passe']) || empty($POST['date_de_naissance']))
    {
      $erreur=true;     
    }else
    {
        //Validation des champs.
        if(!preg_match( $patterNomUtilisateur, $POST['nom_utilisateur'])||!preg_match($patternNom, $POST['nom'])||!preg_match($patternMotdePasse, $POST['mot_de_passe']))
        {
          $erreur=true;
        }
    }  
    return $erreur;
  }

/**
 * Cette fonction permet de créer un utilisateur dans la base de données.
 * @param $connexion
 * @param $POST
 * @return bool|mysqli_result
 */
function utilisateur_insertion($POST):bool
{
    //Connexion a la base de donnees forumEtudiant.
    require(CONNEX_DIR);
    //Déclaration des variables.
    foreach($POST as $cle=>$valeur){
        $$cle = mysqli_real_escape_string($connexion, $valeur);
    }
    //Hashage du mot de passe.
    $mot_de_passe=password_hash($mot_de_passe, PASSWORD_BCRYPT, ['cost' => 10]);
    //Requête SQL.
    $requeteSQL = "INSERT INTO Utilisateur (nom_utilisateur, nom, mot_de_passe, date_de_naissance)
    VALUES ('$nom_utilisateur' ,'$nom','$mot_de_passe','$date_de_naissance')";
    $resultat = mysqli_query($connexion, $requeteSQL);
    return $resultat;
}
?>
