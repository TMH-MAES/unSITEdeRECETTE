<?php if(!empty($_SESSION['auth'])) : ?>
    <form action="" method="post">
      <div class="mb-3">
        <label for="message" class="form-label">Votre Commentaire sur la recette</label>
        <input type="text" class="form-control" id="comment" name="comment">
      </div>
      <button type="submit" class="btn btn-primary ">Commentez</button>
    </form>
<?php endif; ?>
