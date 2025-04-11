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
        <?= isset($_SESSION['id_utilisateur']) 
            ?'<div>
                <li><a href="?controller=forum&function=mesArticles">Mes articles</a></li>
                <li><a href="?controller=forum&function=pageCreation">Créer un Article</a></li>
              </div>': null;
        ?>
      </ul>
      <ul class="nav-right">
        <?= isset($_SESSION['id_utilisateur']) 
            ?'<div>
                <li><a class="deconnexion" href="?controller=utilisateur&function=deconnexion">Déconnexion</a></li>
              </div>'
            :'<div>
                <li><a href="?controller=utilisateur&function=pageCreation">Nouvel utilisateur</a></li>
                <li><a class="connexion" href="?controller=utilisateur&function=pageConnexion">Connexion</a></li>
              </div>'
        ?>
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
