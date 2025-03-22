<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nouvel utilisateur</title>
    <link rel="stylesheet" href="../css/style.css" />
  </head>
  <body>
    <nav>
      <ul>
        \
        <li><a href="index.php">Accueil</a></li>
        <li><a href="formulaire-creation-utilisateur.php">Creation utilisateur</a></li>
        <li><a href="">Connexion</a></li>
        <li><a href="">Creation Article</a></li>
      </ul>
    </nav>
    <main>
      <h1>Creation utilisateur</h1>
      <form action="creation-utilisateur.php" method="post">
        <label for="nom_utilisateur">Nom utilisateur</label>
        <input type="email" id="nom_utilisateur" name="nom_utilisateur" />
        <label for="nom">Nom et prenom</label>
        <input type="text" id="nom" name="nom" />
        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" />
        <label for="date_de_naissance ">Date de naissance</label>
        <input type="date" id="date_de_naissance " name="date_de_naissance " />
        <input type="submit" value="Enregistrer " />
      </form>
    </main>
  </body>
</html>
