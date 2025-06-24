<?php 
/* Traitement données pour la page contact */
session_start();
require_once(__DIR__ . '/header.php');
require_once(__DIR__ . '/functions.php');
$postDatas = $_POST; 
$path="";
$print = false;
if(isset($postDatas["submit"])){
    /* vérification de la nature des donnees */
   if(!empty($postDatas["email"]) && !empty($postDatas["message"])){
      if(!filter_var($postDatas["email"], FILTER_VALIDATE_EMAIL)){
        $_SESSION["contact"]["B"] = "Entrez une addresse mail Valide";
      }
      if(isset($_FILES["screenshot"]) && $_FILES["screenshot"]["error"] == 0){
        if($_FILES["screenshot"]["size"] < 1000000){
          // verifions les extensions
          $allowedExtensions = ["jpg", "png", "pdf", "jpeg"];
          $extension = pathinfo($_FILES["screenshot"]["name"])["extension"];
          if(in_array($extension, $allowedExtensions)){
            $path = __DIR__ . "/uploads/";
            if(is_dir($path)){
               move_uploaded_file($_FILES["screenshot"]["tmp_name"], $path . basename($_FILES["screenshot"]["name"]));
               $isFileUploaded = true;
               $print  = true;
            }else{
              $_SESSION["contact"]["F"] = "Erreur interne, réesayer plustard..";
            }
          }else{
            $_SESSION["contact"]["E"] = "l'extensiion {$extension} non prise en charge";
          }
        }else{
          $_SESSION["contact"]["D"] = "Le fichier doit etre inferieur a 1Mo";
        }
      }else{
        $_SESSION["contact"]["C"] = "Vous n'avez pas uploader de fichier ou le fichier n'est pas valide";
      }
   }else{
     $_SESSION["contact"]["A"] = "Vous n'avez pas rempli de donnees dans les champs requis";
   }
      
}else{
  redirectTo("contact.php");
}
if(!empty($_SESSION["contact"])){
  redirectTo("contact.php");
}


?>
<?php if($print) : ?>
  <div class="container">
      <h1>Message bien recu!</h1>
      <div class='card'>
          <div class='card-body'>
              <h5 class='card-title'>Rappel de vos informations</h5>
              <p class='card-text'><strong>Email: </strong><?= htmlspecialchars($postDatas["email"]) ?></p>
              <p class='card-text'><strong>Message: </strong><?= htmlspecialchars(strip_tags($postDatas["message"])) ?></p>
              <?php if($isFileUploaded): ?>
                <p>Le fichier a bien ete uploade </p>
              <?php endif; ?>
          </div>
    </div>
  </div>  
<?php endif; ?>
<?php require_once(__DIR__ . '/footer.php'); ?>
   
   

 

