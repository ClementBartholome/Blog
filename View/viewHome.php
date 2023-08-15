<?php $this->title = "Mon Blog"; ?>

<?php foreach ($articles as $article): ?>
    <article class="article-card">
        <div>
            <a href="<?= "index.php?action=article&id=" . $article['id'] ?>">
                <h1 class="titrearticle"><?= $article['title'] ?></h1>
            </a>
            <time class="date"><?= $article['date'] ?></time>
        </div>
        <div class="article-content-preview">
            <p class="contenu"><?= mb_strimwidth($article['content'], 0, 300, "..."); ?></p>
            <?php if (!empty($article['image'])): ?>
                <img src="<?= $article['image'] ?>" alt="Image de couverture">
            <?php endif; ?>
        </div>
    </article>
    <hr />
<?php endforeach; ?>

<?php if (isset($_SESSION['user'])): ?>
    <form method="get" action="index.php">
        <input type="hidden" name="action" value="ajouter_article_form">
        <button type="submit">Ajouter un nouvel article</button>
    </form>
<?php endif; ?>