<?php $this->title = "Mon Blog"; ?>

<?php foreach ($articles as $article): ?>
    <article class="article-card">
        <div>
            <a href="<?= "index.php?action=article&id=" . $article->getId() ?>">
                <h1 class="titrearticle"><?= $article->getTitle() ?></h1>
            </a>
            <p>Catégorie <span class="category-tag"><?= $article->getCategory() ?></span></p>
            
            <time class="date"><?= $article->getDate() ?></time>
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

<div class="pagination">

<?php if ($currentPage > 1): ?>
    <a href="index.php?action=home&page=<?= $currentPage - 1 ?>">Précédent</a>
<?php endif; ?>

<!-- Afficher le lien vers la page suivante -->
<?php if ($currentPage < $totalPages): ?>
    <a href="index.php?action=home&page=<?= $currentPage + 1 ?>" class="next-page">Suivant</a>
<?php endif; ?>

</div>

<?php if (isset($_SESSION['user'])): ?>
    <form method="get" action="index.php">
        <input type="hidden" name="action" value="new_article_form">
        <button type="submit">Ajouter un nouvel article</button>
    </form>
<?php endif; ?>