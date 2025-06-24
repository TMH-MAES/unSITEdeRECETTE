<?php
session_start();
require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/config/mysqlconnect.php');

// Vérification 
if(empty($_SESSION['auth']) || empty($_GET['id'])) {
    $_SESSION['flash']['errors'] = ['Action non autorisée'];
    header('Location: index.php');
    exit();
}

$id = (int)$_GET['id'];

// Si confirmation reçue
if(!empty($_POST['confirm'])) {
    try {
        // supprimons la recette, les commentaires et les notations liées a la recette
        $stmt = $mysqlClient->prepare("
           DELETE r, c, re
           FROM recipes r
           LEFT JOIN comments c ON c.recipe_id=:id
           LEFT JOIN reviews re ON re.recipe_id=:id
           WHERE r.id =:id
           AND  r.author=:author
        ");
   
        $stmt->execute([
            'id' => $id,
            'author' => $_SESSION['auth']['email']
        ]);

        if($stmt->rowCount() > 0) {
            $_SESSION['flash']['success'] = "Recette supprimée avec succès";
        } else {
            $_SESSION['flash']['errors'] = ['Vous ne pouvez pas supprimer cette recette'];
        }
        
        header('Location: index.php');
        exit();
        
    } catch(Exception $e) {
        $_SESSION['flash']['errors'] = ['Erreur lors de la suppression'];
        header('Location: index.php');
        exit();
    }
}
?>