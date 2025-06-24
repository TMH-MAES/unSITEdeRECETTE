<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>Supprimer la recette </title>
    <?php include_once(__DIR__ . '/header.php') ?>
</head>
<body>
    <div class="container my-3">
        <div class="card p-4">
            <h3>Supprimer cette recette ?</h3>
            <p class="text-muted mb-4">Cette action est irréversible.</p>
            
            <form method="POST" action="submit_delete.php?id=<?=$_GET["id"]?>" class="d-flex gap-2">
                <button type="submit" name="confirm" value="1" class="btn btn-danger">
                    Confirmer
                </button>
                <a href="index.php" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
    
    <?php require_once(__DIR__ . '/footer.php') ?>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>