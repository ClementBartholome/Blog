<?php $this->titre = "Mon Blog - " . $article['titre']; ?>

<article>
    <div class="article-header">
        <h1 class="titreArticle"><?= $article['titre'] ?></h1>

        <form method="post" action="index.php?action=modifier_article_form&id=<?= $article['id'] ?>">
            <input type="submit" value="Modifier cet article">
        </form>
        
        <form method="post" action="index.php?action=supprimer_article&id=<?= $article['id'] ?>">
            <input type="submit" value="Supprimer cet article">
        </form>

        
    </div>
    <time><?= $article['date'] ?></time>
    <p><?= $article['contenu'] ?></p>
</article>
<hr />
<div>
    <h1 id="titreReponses">Réponses à <?= $article['titre'] ?></h1>
</div>
<?php foreach ($comments as $comment): ?>
    <p><?= $comment['auteur'] ?> dit :</p>
    <p><?= $comment['contenu'] ?></p>
<?php endforeach; ?>
<hr />

<form method="post" action="index.php?action=comment" class="comment-form">
    <input id="auteur" name="auteur" type="text" placeholder="Votre pseudo" 
           required /><br />
    <textarea id="txtCommentaire" name="contenu" rows="4" 
              placeholder="Votre commentaire" required></textarea><br />
    <input type="hidden" name="id" value="<?= $article['id'] ?>" />
    <input type="submit" value="Commenter" />
</form>

