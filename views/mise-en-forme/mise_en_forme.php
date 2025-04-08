<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forum etudiant</title>
    <link rel="stylesheet" href="CSS/style.css" />
  </head>
  <body>
    <nav>
      <ul>
        <li><a href="?controller=base&function=index">Accueil</a></li>
        <li><a href="?controller=utilisateur&function=seConnecter">Connexion</a></li>
        <li><a href="?controller=utilisateur&function=creation">Nouvel utilisateur</a></li>
        <li><a href="?controller=forum&function=creation">Création Article</a></li>
      </ul>
    </nav>
    <main> 
        <?= $contenu; ?>
    </main>
    <footer>
      <p>&copy; 2023 Forum Etudiant</p>
        <p>Site réalisé par Camille Breau</p>
    </footer>
</body>
