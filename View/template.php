<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="./Content/style.css?<?php echo time(); ?>" />
        <title><?= $titre ?></title>
    </head>
    <body>
        <div id="global">
            <header>
                <a href="index.php"><h1 id="titreBlog">Mon Blog</h1></a>
                <p>Bienvenue sur ce blog.</p>
            </header>
            <div id="contenu">
                <?= $contenu ?>
            </div> 
            <footer>
                Blog réalisé avec PHP et MySQL. 
            </footer>
        </div> 
    </body>
</html>