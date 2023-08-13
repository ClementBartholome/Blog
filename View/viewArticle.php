<?php $this->title = "Mon Blog - " . $article['title']; ?>

<article>
    <div class="article-header">
        <h1 class="titreArticle"><?= $article['title'] ?></h1>

        <form method="post" action="index.php?action=modifier_article_form&id=<?= $article['id'] ?>">
            <button type="submit">Modifier cet article</button>
        </form>

        <form method="post" action="index.php?action=supprimer_article&id=<?= $article['id'] ?>">
            <button type="submit">Supprimer cet article</button>
        </form>
    </div>
    <time><?= $article['date'] ?></time>
    <div class="article-content">
        <!-- Cover image -->
        <?php if (!empty($article['image'])): ?>
            <img src="<?= $article['image'] ?>" alt="Image de couverture">
        <?php endif; ?>
        <p><?= $article['content'] ?></p>
    </div>
</article>
<hr />
<div>
    <h1 id="titreReponses">Réponses à l'article "<?= $article['title'] ?>"</h1>
</div>
<?php foreach ($comments as $comment): ?>
    <p><?= $comment['author'] ?> dit :</p>
    <p><?= $comment['content'] ?></p>
<?php endforeach; ?>
<hr />

<form method="post" action="index.php?action=comment" class="comment-form">
    <input id="auteur" name="auteur" type="text" placeholder="Votre pseudo" 
           required /><br />
    <textarea id="txtCommentaire" name="contenu" rows="4" 
              placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $article['id'] ?>" />
    <button type="submit" value="Commenter">Commenter</button>
</form>
