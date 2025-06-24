<?php
include_once ("config/mysqlconnect.php");

// Requete pour recuperer les recettes de notre Base De Donnees en fonction de la note sur celle-ci
$recipeSql = "
    SELECT 
        r.*,
        COALESCE(AVG(rev.note), 1) as moyenne_notes,
        COUNT(rev.review_id) as nb_notes
    FROM recipes r
    LEFT JOIN reviews rev ON rev.recipe_id = r.id
    GROUP BY r.id
    ORDER BY moyenne_notes DESC, nb_notes DESC
";

$recipesQuery = $mysqlClient->query($recipeSql);
$recipes = $recipesQuery -> fetchAll();
 
// Recuperer les donnees des utilisateurs de notre BDD 
$userSql = "SELECT * FROM users ";
// Execute la requete 
$usersQuery = $mysqlClient->query($userSql);
// recupère le tableau d'utilisateur  
$users = $usersQuery -> fetchAll();

