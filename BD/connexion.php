<?php
//Etape 1 : Connexion a la base de donnees forumEtudiant
$connexion = mysqli_connect('localhost', 'root', 'admin', 'forumEtudiant', 3306);

//Etape 2 : Si la connexion ne fonctionne pas, afficher un message d'erreur
if(mysqli_connect_error()){
    echo "Fail to connect ".mysqli_connect_error();
    exit();
}
//Etape 3 : Définir l'encodage des caractères.
mysqli_set_charset($connexion, "utf8");
?>