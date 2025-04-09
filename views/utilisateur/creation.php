    <h1>Création utilisateur</h1>
      <?= isset($donnee['msg'])?$donnee['msg']:null; ?>
      <form action="?controller=utilisateur&function=insertion" method="post">
        <div>
          <label for="nom_utilisateur">Nom utilisateur</label>
          <input type="email" id="nom_utilisateur" name="nom_utilisateur" placeholder="Veuillez saisir votre adresse courriel" required />
        </div>
        <div>
          <label for="nom">Nom et prénom</label>
          <input type="text" id="nom" name="nom" placeholder="Veuillez saisir votre nom" required />
        </div>
        <div>
          <label for="mot_de_passe">Mot de passe</label>
          <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Veuillez saisir un mot de passe" required />
        </div>
        <div>
          <label for="date_de_naissance">Date de naissance</label>
          <input type="date" id="date_de_naissance" name="date_de_naissance" required />
        </div>
        <input type="submit" name="boutonEnvoie" value="Enregistrer" class="btn"/>
      </form>

 