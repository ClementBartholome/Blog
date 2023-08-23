<?php $this->title = "Articles de la catégorie $category"; ?>

<h2>Articles de la catégorie "<?= $category ?>"</h2>

<?php foreach ($articles as $article): ?>
    <article class="article-card">
        <div>
            <a href="<?= "index.php?action=article&id=" . $article->getId() ?>">
                <h1 class="titrearticle"><?= $article->getTitle() ?></h1>
            </a>
            <p>Catégorie <a href="index.php?action=category&category=<?= urlencode($article->getCategory()) ?>" class="category-tag"><?= $article->getCategory() ?></a></p>
            
            <time class="date"><?= Utils::convertDateToFrenchFormat($article->getDate()) ?></time>
        </div>
        <div class="article-content-preview">
            <p class="contenu"><?= mb_strimwidth($article->getContent(), 0, 300, "..."); ?></p>
            <?php if (!empty($article->getImage())): ?>
                <img src="<?= $article->getImage() ?>" alt="Image de couverture">
            <?php endif; ?>
        </div>
    </article>
    <hr />
<?php endforeach; ?>