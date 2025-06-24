<?php
session_start();
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/config/mysqlconnect.php');

// Vérification que l'utilisateur est connecté
if(empty($_SESSION['auth'])) {
    $_SESSION['flash']['errors'] = ['Vous devez être connecté pour modifier une recette'];
    header('Location: index.php');
    exit();
}

// Récupération de la recette à modifier
$currentRecipe = null;
if(isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    // Recherche de la recette dans le tableau $recipes
    foreach($recipes as $recipe) {
        if($recipe['id'] === $id && $recipe['author'] === $_SESSION['auth']['email']) {
            $currentRecipe = $recipe;
            break;
        }
    }
}

// Si recette non trouvée ou non autorisée
if(!$currentRecipe) {
    $_SESSION['flash']['errors'] = ['Recette non trouvée ou modification non autorisée'];
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier <?= htmlspecialchars($currentRecipe['title']) ?> - Site de Recette</title>
</head>
<body>
    <?php if(!empty($_SESSION['flash']['errors']['update'])): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($_SESSION['flash']['errors']['update']) ?>
        </div>
        <?php unset($_SESSION['flash']['errors']['update']); ?>
    <?php endif; ?>

    <main class="container my-5">
        <h2 class="text-primary mb-4">Modifier "<?= htmlspecialchars($currentRecipe['title']) ?>"</h2>
        
        <form action="submit_update.php?id=<?=$_GET["id"]?>" method="post">
            <input type="hidden" name="id" value="<?= $currentRecipe['id'] ?>">
            
            <div class="mb-3">
                <label for="recipe_name" class="form-label">Nom de la Recette</label>
                <input type="text" class="form-control" id="recipe_name" 
                       name="update_name" value="<?= htmlspecialchars($currentRecipe['title']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="message" class="form-label">Étapes de la recette</label>
                <textarea class="form-control" id="message" rows="6" 
                          name="update_message" required><?= htmlspecialchars($currentRecipe['recipe']) ?></textarea>
            </div>
            
            <div class="d-flex gap-4">
                <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
                <a href="index.php" class="btn btn-secondary px-4">Annuler</a>
            </div>
        </form>
    </main>

    <?php require_once(__DIR__ . '/footer.php'); ?>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>