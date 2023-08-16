<h2>Modifier l'article</h2>
<form action="index.php?action=modify_article" method="post" class="add-article-form">
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title" class="title-editor" value="<?= htmlspecialchars($article['title']) ?>"><br>
    <label for="content">Contenu :</label>
    <div class="editor-container">
        <div class="editor-toolbar">
            <button type="button" class="editor-button" data-tag="b"><b>B</b></button>
            <button type="button" class="editor-button" data-tag="i"><i>I</i></button>
            <button type="button" class="editor-button" data-tag="br">↵</button>
        </div>
        <textarea id="content" name="content" class="editor"><?= htmlspecialchars($article['content']) ?></textarea>
    </div>
    <input type="hidden" name="idArticle" value="<?= $article['id'] ?>">
    <button type="submit">Modifier</button>
</form>

