<?php

/* fonction générale pour l'application web */

function isValidRecipe(array $recipe) : bool{
    
    if(array_key_exists("is_enabled", $recipe) && $recipe["is_enabled"] === true){
        $isEnable = $recipe["is_enabled"];
    }else{
        $isEnable = false;
    }
    return $isEnable;
}
// récupération des recettes valides
function getRecipes(array $recipes) : array{
    $validRecipes = [];
    foreach($recipes as $recipe){
        if(array_key_exists("is_enabled", $recipe) && $recipe["is_enabled"]){
            $validRecipes[] = $recipe;
        }
    }
    return $validRecipes;
}
// pour afficher un nom d'autheur
function displayAuthor($email, array $users): string{
    $authorName = "Autheur Inconnu";
    foreach($users as $user){
        if($email == $user["email"]){
            $authorName = $user["full_name"] . '( ' . $user["age"] . ' ans )' ;
        }
    }
    return $authorName;
}
// recuperer un utilisateur en fonction de son email
function getUserByEmail(string $email) {
    global $users;
    foreach($users as $user) {
        if($user["email"] === $email) {
            return $user; // Retourne toute les infos de l'utilisateur
            break;
        }
    }
    return null;
}
// redirige vers une page spécifique
function redirectTo($url){
    header('Location: ' . $url);
    exit;
}
// pour reduire les étapes d'une recette et ajouter (un voir plus)
function shortenText(string $text, int $id, int $maxLength = 100): string
{
    if (strlen($text) <= $maxLength) {
        return $text; 
    }
    
    $shortText = htmlspecialchars(substr($text, 0, $maxLength));
    $link = '... <a href="recipes_read.php?id='.urlencode($id).'" style="color: #007bff; text-decoration: none;">Voir plus</a>';
    
    return $shortText . $link;
}
// recuperer une recette par son identifiant
function getRecipeById(int $id, array $recipes): ?array
{
    foreach ($recipes as $recipe) {
        if ($recipe['id'] === $id) {
            return $recipe;
        }
    }
    
    return null;
}
?>
