<h2>Modifier l'article</h2>
<form action="index.php?action=modifier_article" method="post" class="add-article-form">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" class="title-editor" value="<?= htmlspecialchars($article['titre']) ?>"><br>
    <label for="contenu">Contenu :</label>
    <div class="editor-container">
        <textarea id="contenu" name="contenu" class="editor"><?= htmlspecialchars($article['contenu']) ?></textarea>
    </div>
    <input type="hidden" name="idArticle" value="<?= $article['id'] ?>">
    <button type="submit">Modifier</button>
</form>
