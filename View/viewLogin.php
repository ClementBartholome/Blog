<?php $title = "Connexion"; // Titre de la page ?>

<!-- Affichage du message d'erreur si présent -->
<?php if (!empty($errorMessage)): ?>
    <p class="error-message"><?= $errorMessage ?></p>
<?php endif; ?>

<!-- Formulaire de connexion -->
<form action="index.php" method="post">
    <div>
        <label for="login" class="form-label">Identifiant</label>
        <input type="text" class="form-control" id="login" name="login" required>
    </div>
    <div>
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>
