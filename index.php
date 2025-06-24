<?php
// demmarrage de la session  et  inclusion des fichiers ness....
session_start();
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');
?>
<title>Acceuil - Site de Recette</title>
<?php include_once(__DIR__ . '/header.php') ?>

<?php if(!empty($_SESSION["flash"]["errors"])): //verifier s'il y a des erreurs?>
  <div class="alert alert-danger">
    <?php foreach($_SESSION["flash"]["errors"] as $error) : ?>
      <li><?= $error ?></li>
    <?php endforeach; ?>
  </div>

<?php endif; ?>
<?php if(!empty($_SESSION["flash"]["success"])) : ?>
   <div class="alert alert-success">
     <p><?=$_SESSION["flash"]["success"]?></p>
   </div>
<?php endif; ?> 
<?php include_once(__DIR__ . "/login.php"); ?>
<?php unset($_SESSION["flash"]); // supprimer les messages d'erreurs après leur affichage?>

<div class="container my-3">
      <h1 class=" mb-4">Nos recettes</h1>
      <?php foreach(getRecipes($recipes) as  $recipe) : ?>
          <div class="mt-1">
              <a  href="recipes_read.php?id=<?=$recipe["id"]?>" class="text-decoration-none"><h3 class="card-title"><?= $recipe['title'] ?> </h3></a>
              <p class="card-text mt-2"><?= shortenText($recipe['recipe'],$recipe["id"], 100) ?></p>
              <p><em><?= displayAuthor($recipe['author'], $users) ?></em></p>
              <?php if (isset($_SESSION['auth']) && $recipe['author'] === $_SESSION['auth']['email'] OR (isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === 1) ): ?>
                    <ul class="list-group  list-group-horizontal">
                        <li class="list-group-item "><a class="link-warning text-decoration-none" href="recipes_update.php?id=<?php echo($recipe['id']); ?>">Editer la recette <i class="bi bi-pencil"></i></a></li>
                        <li class="list-group-item"><a class="link-danger text-decoration-none" href="recipes_delete.php?id=<?php echo($recipe['id']); ?>">Supprimer la recette  <i class="bi bi-trash"></i></a></li>
                    </ul>
              <?php endif; ?>
          </div>
      <?php endforeach; ?>
</div>

<?php require_once(__DIR__ . '/footer.php')  ?>