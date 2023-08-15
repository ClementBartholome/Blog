<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="./Content/style.css?<?php echo time(); ?>" />
        <title><?= $title ?></title>
    </head>
    <body>
        <div id="global">
            <header>
                <a href="index.php">
                    <h1 class="blog-title">Mon Blog</h1>
                </a>
                <p class="blog-welcome">Bienvenue sur ce blog.</p>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="index.php?action=logout" class="btn-connexion">Se déconnecter</a>
                <?php else: ?>
                    <a href="index.php?action=loginform" class="btn-connexion">Se connecter</a>
                <?php endif; ?>
            </header>
            <div id="contenu">
                <?= $content ?>
            </div> 
            <footer>
                Blog réalisé avec PHP et MySQL. 
            </footer>
        </div> 
        <script src="./js/setupEditorButtons.js"></script>
    </body>
</html>
