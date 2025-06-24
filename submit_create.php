<?php
session_start();
require_once(__DIR__."/header.php");
require_once(__DIR__."/functions.php");
require_once(__DIR__."/config/mysqlconnect.php");
if(!empty($_POST["title"]) && !empty($_POST["recipe"])){
    $title = filter_var($_POST["title"]);
    $recipe = filter_var($_POST["recipe"]);
    $insertSql = $mysqlClient -> prepare("INSERT INTO recipes(title, recipe,author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)");
    $insertSql->execute([
        'title' => $title,
        'recipe' => $recipe,
        'author' => $_SESSION["auth"]["email"],
        'is_enabled' => 1,
    ]);
    $print = true;
}else{
    $_SESSION["flash"]["errors"]["create"] = "Entrer des données valides pour créer la recette";
    redirectTo("recipes_create.php");
}
?>
<?php if($print): ?>
    <div class="container">
        <h1>Recette Crée avec success!</h1>
        <div class='card'>
            <div class='card-body'>
                <h5 class='card-title'><?= $title ?></h5>
                <p class='card-text'><strong>Autheur: </strong><?= $_SESSION["auth"]["email"] ?></p>
                <p class='card-text'><strong>Recette: </strong><?= htmlspecialchars(strip_tags($_POST["recipe"])) ?></p>
                
            </div>
    </div>
    </div>
<?php endif; ?>