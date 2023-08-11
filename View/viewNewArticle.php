<h2>Ajouter un nouvel article</h2>
<form action="index.php?action=ajouter_article" method="post" class="add-article-form">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" class="title-editor"><br>
    <label for="contenu">Contenu :</label>
    <div class="editor-container">
        <div class="editor-toolbar">
            <button type="button" class="editor-button"><b>B</b></button>
            <button type="button" class="editor-button"><i>I</i></button>
        </div>
        <textarea id="contenu" name="contenu" class="editor"></textarea>
    </div>
    <br>
    <input type="submit" value="Ajouter">
</form>