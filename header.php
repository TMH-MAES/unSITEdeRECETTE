<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Taille des icônes */
        .navbar .bi {
            font-size: 1rem;
            vertical-align: middle;
            margin-right: 0.3rem;
        }
        
        /* Adaptation mobile */
        @media (max-width: 991.98px) {
            #navbarContent {
                display: none !important;
            }
            #navbarContent.show {
                display: block !important;
            }
            .navbar-brand {
                flex-grow: 1;
            }
        }
    </style>
</head>
<?php
$current_page = basename($_SERVER['PHP_SELF']); // c'est connaitre la page courante
?>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <!-- Marque du site -->
                <a class="navbar-brand me-4" href="index.php">
                    <i class="bi bi-egg-fried"></i>
                    <span class="d-none d-sm-inline">Site de Recette</span>
                </a>
                
                <!-- Toggler mobile -->
                <button class="navbar-toggler" type="button" 
                        data-bs-toggle="collapse" data-bs-target="#navbarContent"
                        aria-controls="navbarContent" aria-expanded="false"
                        aria-label="Menu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Menu principal -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">
                                <i class="bi bi-house-door"></i>
                                <span class="ms-1">Accueil</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($current_page == 'contact.php') ? 'active' : '' ?>" href="contact.php">
                                <i class="bi bi-envelope"></i>
                                <span class="ms-1">Contact</span>
                            </a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link <?= ($current_page == 'apropos.php') ? 'active' : '' ?>" href="apropos.php">
                               <i class="bi bi-info-circle"></i>
                               <span class="ms-1">À propos</span>
                           </a>
                       </li>
                        <?php if(!empty($_SESSION["auth"])) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($current_page == 'recipes_create.php') ? 'active' : '' ?>" href="recipes_create.php">
                                <i class="bi bi-plus-circle"></i>
                                <span class="ms-1">Créer</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>

                    <!-- Boutons de connexion -->
                    <div class="ms-auto">
                        <?php if(!empty($_SESSION["auth"])) : ?>
                        <a href="logout.php" class="btn btn-danger btn-sm">
                            <i class="bi bi-power"></i>
                            <span class="d-none d-md-inline">Déconnexion</span>
                        </a>
                        <?php else : ?>
                          
                         <a href="login.php" class="btn btn-outline-light btn-sm">
                            <i class="bi bi-box-arrow-in-right"></i>
                            <span class="d-none d-md-inline">Connexion</span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>