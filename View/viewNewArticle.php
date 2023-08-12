<h2>Ajouter un nouvel article</h2>
<form action="index.php?action=ajouter_article" method="post" class="add-article-form" enctype="multipart/form-data">
    <label for="titre">Titre :</label>
    <input type="text" id="titre" name="titre" class="title-editor"><br>
    <label for="contenu">Contenu :</label>
    <div class="editor-container">
        <div class="editor-toolbar">
            <button type="button" class="editor-button" data-tag="b"><b>B</b></button>
            <button type="button" class="editor-button" data-tag="i"><i>I</i></button>
        </div>
        <textarea id="contenu" name="contenu" class="editor"></textarea>
    </div>
    <br>
    <label for="image">Image de couverture :</label>
    <input type="file" id="image" name="image"><br>
    <button type="submit">Ajouter l'article</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editorButtons = document.querySelectorAll('.editor-button');

        editorButtons.forEach(button => {
            button.addEventListener('click', () => {
                const editor = document.querySelector('.editor');
                const startPos = editor.selectionStart;
                const endPos = editor.selectionEnd;
                const selectedText = editor.value.substring(startPos, endPos);
                const tag = button.getAttribute('data-tag');
                const tagOpen = `<${tag}>`;
                const tagClose = `</${tag}>`;
                const newText = editor.value.substring(0, startPos) + tagOpen + selectedText + tagClose + editor.value.substring(endPos);

                editor.value = newText;
                editor.selectionStart = startPos + tagOpen.length;
                editor.selectionEnd = endPos + tagOpen.length;
                editor.focus();
            });
        });
    });
</script>
