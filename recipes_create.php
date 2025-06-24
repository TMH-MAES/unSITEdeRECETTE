<?php 
session_start();
require_once(__DIR__ . "/header.php");
?>
<?php if(!empty($_SESSION["flash"]["errors"]["create"])) : ?>
  <div class="alert alert-danger">
    <li><?= $_SESSION["flash"]["errors"]["create"] ?></li>
  </div>
<?php endif; 
unset($_SESSION["flash"]["errors"]["create"]);?>
<main class="container my-5">
    <h2 class="text-primary mb-4">Création de Recette</h2>
    <form action="submit_create.php" method="post" >
      
      <div class="mb-3">
        <label for="recipe_name" class="form-label">Nom de la Recette </label>
        <input type="text" class="form-control" id="titlr" placeholder="Comme le Ndole" name="title">
      </div>
      <div class="mb-3">
        <label for="message" class="form-label">Etape de la recette</label>
        <textarea class="form-control" id="recipe" rows="4" placeholder="" name="recipe"></textarea>
      </div>
      
      <button type="submit" name="submit" class="btn btn-primary">Creer la recette</button>
    </form>
  </main>
<?php require_once("footer.php"); ?>