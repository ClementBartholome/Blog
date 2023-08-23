<?php $this->title = "Mon Blog - " . $article->getTitle(); ?>

<article>
    <div class="article-header">
        <h1 class="titreArticle"><?= $article->getTitle() ?></h1>
        <?php if (isset($_SESSION['user'])): ?>
            <form method="post" action="index.php?action=modify_article_form&id=<?= $article->getId() ?>">
                <button type="submit">Modifier cet article</button>
            </form>

            <form method="post" action="index.php?action=delete_article&id=<?= $article->getId() ?>">
                <button type="submit">Supprimer cet article</button>
            </form>
        <?php endif; ?>
    </div>
    <p>Catégorie <span class="category-tag"><?= $article->getCategory() ?></span></p>
    <time><?= Utils::convertDateToFrenchFormat($article->getDate()) ?></time>
    <div class="article-content">
        <!-- Cover image -->
        <?php if (!empty($article->getImage())): ?>
            <img src="<?= $article->getImage() ?>" alt="Image de couverture">
        <?php endif; ?>
        <p><?= $article->getContent() ?></p>
    </div>
</article>
<hr />
<div>
    <h1 id="titreReponses">Commentaires de l'article "<?= $article->getTitle() ?>"</h1>
</div>
<?php foreach ($comments as $comment): ?>
    <p><?= $comment['author'] ?> dit :</p>
    <p><?= $comment['content'] ?></p>
<?php endforeach; ?>
<hr />

<form method="post" action="index.php?action=comment" class="comment-form">
    <input id="author" name="author" type="text" placeholder="Votre pseudo" 
           required /><br />
    <textarea id="txtCommentaire" name="content" rows="4" 
              placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $article->getId() ?>" />
    <button type="submit">Commenter</button>
</form>
