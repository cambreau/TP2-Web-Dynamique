<?php
//Etape 1 : Si la methode de requete n'est pas POST, rediriger vers la page formulaire -creation-utilisateur.php
if($_SERVER['REQUEST_METHOD'] != "POST"){
    header('location:formulaire-creation-utilisateur.php');
}

//Etape 2 : Connexion a la base de donnees forumEtudiant
require('connexion.php');

//Etape 3 : Récupérer les données du formulaire
foreach($_POST as $cle=>$valeur){
    $$cle = mysqli_real_escape_string($connexion, $valeur);
}

// echo"$nom_utilisateur <br> $nom <br> $mot_de_passe <br> $date_de_naissance"; Code pour tester si les données sont bien récupérées.

//Etape 4 : Vérifier si l'utilisateur existe déjà
$requeteSQL = "SELECT * FROM Utilisateur WHERE nom_utilisateur = '$nom_utilisateur'";
$resultat = mysqli_query($connexion, $requeteSQL);
$compteurLigne = mysqli_num_rows($resultat);

//Etape 5 : Si l'utilisateur existe déjà, rediriger vers la page formulaire -creation-utilisateur.php
if($compteurLigne > 0){
    // header('location:formulaire-creation-utilisateur.php');
    echo "L'utilisateur existe déjà";
}
else{ 
    //Etape 6 : Créer un nouvel utilisateur
    "INSERT INTO Utilisateur (nom_utilisateur, nom, mot_de_passe, date_de_naissance)
     VALUES ('$nom_utilisateur' ,'$nom','$mot_de_passe','$date_de_naissance')";
    }

    if(mysqli_query($connexion, $requeteSQL)){
        header('location:formulaire-creation-utilisateur.php');
    }else{
        header('location:formulaire-creation-utilisateur.php');
    }
    
    ?>