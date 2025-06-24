<?php
// demmarre la session
session_start();
$print=false;
// inclusion des fichiers
require_once(__DIR__."/header.php");
require_once(__DIR__."/functions.php");
require_once(__DIR__."/config/mysqlconnect.php");
// vérification des données
if(!empty($_POST["update_name"]) && !empty($_POST["update_message"])){
    // Filtrer les valeurs des variables 
    $title = filter_var($_POST["update_name"]);
    $recipe = filter_var($_POST["update_message"]);
    // Requete SQL pour mettre a jour la recette 
    $updateSql = $mysqlClient -> prepare("UPDATE recipes SET title=:title , recipe=:recipe WHERE id=:id");
    // Exécute la requete
    $updateSql->execute([
        'title' => $title,
        'recipe' => $recipe,
        'id' => $_GET["id"],
    ]);
    // active le booléen
    $print = true;
}else{
    // ajoute une erreur dans le tableau de session
    $_SESSION["flash"]["errors"]["update"] = "Entrer des informations pour la modification de la recette";
    // on verifie la nature de l'id 
    if(!is_int($_SESSION["auth"]["id"])){
        redirectTo("recipes_update.php");
    }
    // redirige vers la page de mise a jour
    redirectTo("recipes_update.php");
}
?>
<?php if($print) : ?>
    <div class="container">
        <h1>Recette modifiée avec succes!</h1>
        <div class='card'>
            <div class='card-body'>
                <h5 class='card-title'><?= $title ?></h5>
                <p class='card-text'><strong>Autheur: </strong><?= $_SESSION["auth"]["email"] ?></p>
                <p class='card-text'><strong>Recette: </strong><?= htmlspecialchars(strip_tags($_POST["update_message"])) ?></p>
                
            </div>
    </div>
    </div>
    <?php require(__DIR__."/footer.php");?>
<?php endif; ?>