<?php require_once(__DIR__."/header.php"); ?>
<?php if(empty($_SESSION["auth"])) : ?>
  <title>Connexion - Site de Recette</title>
  <!-- CONTENU PRINCIPAL -->
  <main class="container my-5">
    <h2 class="text-primary mb-4">Formulaire de Connexion</h2>
    <form action="submit_login.php" method="post">
      <div class="mb-3">
        <label for="email" class="form-label">Adresse email</label>
        <input type="email" class="form-control" id="email" placeholder="email@exemple.com" name="email">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <button type="submit" class="btn btn-primary">Envoyer</button>
     
    </form>



  </main>
<?php endif; ?>