<?php $this->titre = "Mon Blog"; ?>

<?php foreach ($articles as $article): ?>
    <article class="article-card">
        <div>
            <a href="<?= "index.php?action=article&id=" . $article['id'] ?>">
                <h1 class="titrearticle"><?= $article['titre'] ?></h1>
            </a>
            <time class="date"><?= $article['date'] ?></time>
        </div>
        <p class="contenu"><?= mb_strimwidth($article['contenu'], 0, 300, "..."); ?></p>
    </article>
    <hr />
<?php endforeach; ?>

<form method="get" action="index.php">
    <input type="hidden" name="action" value="ajouter_article_form">
    <button type="submit">Ajouter un nouvel article</button>
</form>