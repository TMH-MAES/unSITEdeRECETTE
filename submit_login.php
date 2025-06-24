<?php
session_start();
require_once(__DIR__ . "/variables.php");
require_once(__DIR__ . "/functions.php");
require_once(__DIR__."/config/mysqlconnect.php");
$postedDatas = $_POST;

if(isset($postedDatas["email"])  && isset($postedDatas["password"])){
    if(!filter_var($postedDatas["email"], FILTER_VALIDATE_EMAIL)){
       $_SESSION["flash"]["errors"]["email"] = "Entrez une addresse mail correcte";
    }
    // vérifier son existence
    $user = getUserByEmail($postedDatas['email']);
    
    if($user!==null  && $postedDatas["password"] === $user["p"]){ 
        $_SESSION["auth"] = [
            "email" => $postedDatas["email"],
            "id" => $user["id"],
            
        ];
        $query = $mysqlClient->prepare("SELECT is_admin FROM users WHERE id=:id");
        $query->execute([
            "id"=>$user["id"],
        ]);
        $_SESSION["is_admin"] = $query->fetch();
        $_SESSION["flash"]["success"] =   "Bonjour " . $_SESSION["auth"]["email"]. " Bienvenu sur le site";

    }else{
       $_SESSION["flash"]["errors"]["notAccountErrors"] = "parametre invalide ou service en cours d'implementation";
    }
 
}
redirectTo("index.php");
