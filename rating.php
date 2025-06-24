<?php
$loginUrl = "login.php";

?>

<?php if(!empty($_SESSION["auth"])): ?>
    <div class="rating-container">
        <!-- Affichage de la moyenne -->
        <div class="average-rating mb-3">
            <h5>Note moyenne: 
                <span class="badge bg-primary">
                    <?= htmlspecialchars(round($recette["moyenne_notes"])) ?>/10
                    
                </span>
                <?php if($recette["nb_notes"] > 0): ?>
                    <small class="text-muted">(<?= $recette["nb_notes"] ?> avis)</small>
                <?php endif; ?>
            </h5>
            
        </div>

        <!-- Section notation -->
        <?php if(!$hasNoted): ?>
            <div class="rating-section mb-4">
                <h4 class="mb-3">Donnez votre avis</h4>
                <form action="" method="post" class="rating-form">
                    <div class="btn-group" role="group" aria-label="Notation de 0 à 10">
                        <?php for($i = 0; $i <= 10; $i++): ?>
                            <button type="submit" 
                                    name="note" 
                                    value="<?= htmlspecialchars($i) ?>" 
                                    class="btn btn-outline-primary rating-btn <?= ($i <= 5) ? 'border-danger' : 'border-success' ?>"
                                    aria-label="Noter <?= $i ?> sur 10">
                                <?= $i ?>
                            </button>
                        <?php endfor; ?>
                    </div>
                    <p class="form-text text-muted mt-2">0 = Très mauvais, 5 = Moyen, 10 = Excellent</p>
                </form>
            </div>
        <?php else: ?>
            <div class="alert alert-info mt-3" role="alert">
                <i class="bi bi-check-circle me-2"></i> Merci pour votre notation !
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="rating-container">
        <div class="average-rating mb-3">
            <h5>Note moyenne: 
                <span class="badge bg-primary">
                    <?= htmlspecialchars(round($recette["moyenne_notes"],1)) ?>/10
                </span>
                <?php if($recette["nb_notes"] > 0): ?>
                    <small class="text-muted">(<?= $recette["nb_notes"] ?> avis)</small>
                <?php endif; ?>
            </h5>
        </div>
        
        <div class="alert alert-warning mt-3" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <a href=<?=$loginUrl?> class="alert-link">Connectez-vous</a> pour noter et commenter cette recette
        </div>
    </div>
<?php endif; ?>