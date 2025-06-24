<?php 
//  on recupere les fichiers de base
session_start();
require_once(__DIR__."/header.php");
require_once(__DIR__."/variables.php");
require_once(__DIR__."/functions.php");
$recipeExist = false;
$hasNoted = false;
$recette = null;
if(!empty($_GET["id"]) && $_GET["id"] > 0){
     $recette = getRecipeById($_GET["id"], $recipes);
     
     $id = $recette["id"];
     $recipeExist = true;
     
     // verifions d'abord si le user est connectée avant toute manipulation du genre commentaire et note
     if(!empty($_SESSION["auth"])){
           // vérifions si la recette à deja ete note par l'utilisateur connecté
          $checkNoteStatement = $mysqlClient -> prepare("SELECT note FROM reviews WHERE user_id=:user AND recipe_id=:recipe_id");
          $checkNoteStatement -> execute([
               "user" => $_SESSION["auth"]["id"],
               "recipe_id" => $id,
          ]);
          $noteFromDB = $checkNoteStatement->fetch();
          $hasNoted = ($noteFromDB !== false);
     
          // inserer la note de la recette dans la relation reviews
          if(!empty($_POST["note"]) && !$hasNoted){
               
               $note = (int)$_POST["note"];
               if($note>=0 && $note<=10){
               $insertReviewStatement = $mysqlClient -> prepare("INSERT INTO reviews(note, recipe_id, user_id) VALUES(:note, :id_recipe, :user_id)");
               $insertReviewStatement->execute([
                    "note" => $note,
                    "id_recipe" => $id,
                    "user_id" => $_SESSION["auth"]["id"],
               ]);
               $hasNoted = true;
               $_SESSION["read"]["s"] = "La recette à été notée avec succes";
               }else{
                    $_SESSION["read"] = "La note doit etre comprise entre 0 et 10";
               }
          }
          // si un utilisateur connecté veut commenter , on insere les donneees
          if(!empty($_POST["comment"])){
               $commentValue = filter_var($_POST["comment"]);
               $insertCommentSql = $mysqlClient -> prepare("INSERT INTO comments(user_id, recipe_id, comment, created_at) VALUES (:user_id, :recipe_id, :comment,NOW())");
               $insertCommentSql->execute([
                    "user_id" => $_SESSION["auth"]["id"],
                    "recipe_id" => $id,
                    "comment" => $commentValue,
                    
               ]);
               
          }
          
        
    }
      // recupération  des commentaires liéés a la recette
     $commentSql = $mysqlClient -> prepare("
     SELECT u.full_name, c.comment, c.created_at
     FROM recipes r
     LEFT JOIN comments c ON c.recipe_id = r.id
     LEFT JOIN users u ON u.id = c.user_id
     WHERE r.id = :recipe_id
     ORDER BY c.created_at DESC
     LIMIT 10
     ");
   
     $commentSql->execute([
          "recipe_id" => $id,
     ]);
     $comments = $commentSql -> fetchAll();
}
    
if(!$recipeExist){
     redirectTo("index.php");
}

?>
<?php if(!empty($_SESSION["read"]["s"])) : ?>
     <div class="alert alert-success">
          <li><?=$_SESSION["read"]["s"]?></li>
     </div>
<?php endif; unset($_SESSION["read"]["s"]) ?>
<?php if($recipeExist) : ?>
    <div class="container">
            <h1><?= $recette["title"] ?></h1>
            <p class='card-text mb-4'><strong>Autheur: </strong><?php echo $recette["author"]; ?></p>
            <div class="card">
               <div class='card-body'>
                    <p class="card-text mb-10"><strong>Recette</strong></p>
                    <p class="card-text"><?=htmlentities(strip_tags($recette["recipe"]))?></p>    
                </div>
           </div> 

           <?php require_once(__DIR__."/rating.php"); ?>
           <h3>Commentez la recette!</h3>   
          
           <!-- Affichage des commentaires -->
           <?php if (!empty($comments)) : ?>
               <?php foreach ($comments as $comment) : ?>
                    <p><b><?php echo $comment["full_name"] ?></b> <?php echo $comment["created_at"]?></p>
                    <p><?php echo $comment["comment"]; ?></p>
               <?php endforeach; ?>
           <?php endif; ?>
           <?php if(empty($comments)) : ?>
             <p>Aucun commentaire</p>
           
           <?php endif; ?>
           <?php require_once(__DIR__."/add_comment.php"); ?>
    </div>
<?php endif; ?>
