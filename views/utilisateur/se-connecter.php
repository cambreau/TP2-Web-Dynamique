    <h1>Se connecter</h1>
        <div>
          <form action="?controller=utilisateur&function=connexion" method="post">
              <?= "<span class='erreur'>".$msg."</span>"; ?>
              <div>
              <label for="nom_utilisateur">Nom utilisateur</label>
                <input type="email" id="nom_utilisateur" name="nom_utilisateur" 
                placeholder="Veuillez saisir votre nom d'utilisateur" required>
              </div>
              <div>
                <label for="mot_de_passe">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Veuillez saisir votre mot de passe" required>
              </div>
              <input type="submit" value="Se connecter" class="btn">
          </form>
          <a href="formulaire-utilisateur.php">Créer un compte</a>
      </div>    