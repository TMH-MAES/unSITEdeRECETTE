<?php 
session_start();
// demande du fichier header.php
require_once(__DIR__ . '/header.php'); 
?>
<?php if(!empty($_SESSION["contact"])) : ?>
  <?php foreach($_SESSION["contact"] as $error) : ?>
    <div class="alert alert-danger">
      <ul>
        <li><?php echo $error; ?></li>
      </ul>
    </div>
  <?php endforeach; ?>
<?php endif; unset($_SESSION["contact"]); ?>

  <title>Contact - Site de Recette</title>
  <!-- CONTENU PRINCIPAL -->
  <main class="container my-5">
    <h2 class="text-primary mb-4">Formulaire de Contact</h2>
    <form action="submit_contact.php" method="post" enctype="multipart/form-data"/>
      
      <div class="mb-3">
        <label for="email" class="form-label">Adresse email</label>
        <input type="email" class="form-control" id="email" placeholder="email@exemple.com" name="email">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" rows="4" placeholder="Votre message..." name="message"></textarea>
      </div>
      <div class="mb-3">
        <label for="screenshot" class="form-label">Votre Capture d'écran </label>
        <input class="form-control" type="file" id="screenshot" name="screenshot">
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
    </form>
  </main>
<?php require_once(__DIR__ . '/footer.php') ?>
