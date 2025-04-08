<?php
//Étape 1: Si la méthode de requête n'est pas POST, rediriger vers la page du formulaire de redirection.
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('location:index.php');
    die();
}

//Étape 2 : Connexion a la base de donnees forumEtudiant.
require('BD/connexion.php');

//Étape 3 : Déclaration des variables.
foreach($_POST as $cle=>$valeur){
    $$cle = mysqli_real_escape_string($connexion, $valeur);
}

//Étape 4 : Vérifier si l'utilisateur existe déjà.
//Requête SQL.
$requeteSQL ="SELECT * FROM utilisateur WHERE nom_utilisateur='$nom_utilisateur'";
$resultat = mysqli_query($connexion, $requeteSQL);

//Compter le nombre de lignes de $resultat.
$compteurLigne = mysqli_num_rows($resultat);
if($compteurLigne  == 1){
    //Si l'utilisateur existe, valider le mot de passe.
    $utilisateur= mysqli_fetch_array($resultat, MYSQLI_ASSOC);
    if(password_verify($mot_de_passe, $utilisateur['mot_de_passe'])){
        //Si le mot de passe est correct, créer une session.
         header('location:forum.php');}
         else{
            header('location:index.php?msg=1');}
}else{
    header('location:index.php?msg=2');
}
?>