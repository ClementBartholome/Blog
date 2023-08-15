<?php $title = "Connexion"; // Titre de la page ?>

<!-- Formulaire de connexion -->
<form action="index.php?action=login" method="post" class="login-form">
    <div>
        <label for="login" class="form-label">Identifiant</label>
        <input type="text" class="form-control" id="login" name="login" required>
    </div>
    <div>
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <?php if (isset($error)): ?>
        <p class="error-message"><?= $error ?></p>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
