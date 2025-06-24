<?php
$errors = [];

// Récupération des données
$full_name = trim($_POST["full_name"] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['Z'];
$confirm_password = $_POST['confirm_password'] ?? '';
$age = (int)($_POST["age"] ?? 0);

// Validation
if (empty($full_name)) {
    $errors[] = "Le nom complet est requis";
} elseif (strlen($full_name) < 3) {
    $errors[] = "Le nom doit faire au minimum 3 caractères";
}

if (empty($email)) {
    $errors[] = "L'email est requis";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Format d'email invalide";
}

if (empty($password)) {
    $errors[] = "Le mot de passe est requis";
} elseif (strlen($password) < 8) {
    $errors[] = "Le mot de passe doit contenir au moins 8 caractères";
} elseif (!preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
    $errors[] = "Le mot de passe doit contenir au moins une majuscule et un chiffre";
}

if ($password !== $confirm_password) {
    $errors[] = "Les mots de passe ne correspondent pas";
}

if($age <= 0) {
    $errors[] = "L'âge doit être positif";
} elseif($age >= 150) {
    $errors[] = "L'âge doit être inférieur à 150";
}

if (empty($errors) && false) {
    require_once(__DIR__.'/config/mysqlconnect.php');
    
    // Vérification si email existe déjà
    $stmt = $mysqlClient->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->fetch()) {
        $errors[] = "Cet email est déjà utilisé";
    } else {
        // Hash du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Insertion en base
        $insertStmt = $mysqlClient->prepare("
            INSERT INTO users (full_name, email, p, age)  VALUES (?, ?, ?, ?)
        ");
        
        if ($insertStmt->execute([
            $full_name, 
            $email, 
            $hashedPassword,
            $age
        ])) {
            $_SESSION['flash']['success'] = "Inscription réussie ! Vous pouvez maintenant vous connecter";
            //header('Location: login.php');
            //exit;
            var_dump($_POST);
        } else {
            $errors[] = "Une erreur est survenue lors de l'inscription";
        }
    }
}

