<?php 

function utilisateur_controller_creation(){
 render(fichier: 'utilisateur/creation.php');
}

function utilisateur_controller_insertion($POST){
    // Inclure le modèle utilisateur
    require_once(MODEL_DIR."/utilisateur/utilisateur.php");
    //Appeler la fonction d'insertion de l'utilisateur dans la base de données
    $resultat = utilisateur_insertion($POST);
    // Si l'insertion réussie, rediriger vers la page de connexion
    if($resultat){
        render("utilisateur/se-connecter.php", [
            'msg' => "<p class='message succes'>Inscription réussie. Vous pouvez vous connecter.</p>"
        ]);
    }else{
        // Si l'insertion échoue, afficher un message d'erreur
        render("utilisateur/creation.php", [
            'msg' => "<p class='message erreur'>Erreur lors de l'inscription. Veuillez réessayer.</p>"
        ]);
    }

}
function utilisateur_controller_validation($POST){
    // Inclure le modèle utilisateur
    require(MODEL_DIR."/utilisateur/utilisateur.php");
    // Valider si l'utilisateur existe déjà.
    // Si l'utilisateur existe, afficher un message d'erreur.
    if(utilisateur_existe($POST['nom_utilisateur'])){
        render(fichier:'utilisateur/creation.php', donnee: [
            'msg' => "<p class='message erreur'>Le nom d'utilisateur existe déjà.</p>"
        ]);
    }else{
        // Validation des champs
        // Si erreur, afficher un message d'erreur
        $erreur = utilisateur_validation_champ($POST);
        if($erreur){
            render(fichier:'utilisateur/creation.php', donnee: [
                'msg' => 
                    "<div class=' message erreur'>
                        <p>Erreur lors de l'inscription.</p>
                        <p>Veuillez respecter les régles suivantes:</p>
                        <ul>
                            <li>Tous les champs sont obligatoires</li>
                            <li>Le nom d'utilisateur doit être une adresse email valide</li>
                            <li>Le nom doit contenir entre 2 et 25 lettres</li>
                            <li>Le mot de passe doit contenir des chiffres et des lettres entre 6 et 20 caractères</li>
                            <li>La date de naissance doit être au format AAAA-MM-JJ</li> 
                        </ul>
                    </div>"
            ]);
        }else{
            // Si pas d'erreur: insertion de l'utilisateur dans la base de données
            utilisateur_controller_insertion($POST);
        }
    }
}



?>