function setupEditorButtons() {
  const editorButtons = document.querySelectorAll(".editor-button");

  editorButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const editor = document.querySelector(".editor");
      const startPos = editor.selectionStart;
      const endPos = editor.selectionEnd;
      const selectedText = editor.value.substring(startPos, endPos);
      const tag = button.getAttribute("data-tag");
      const tagOpen = `<${tag}>`;
      const tagClose = `</${tag}>`;
      const newText =
        editor.value.substring(0, startPos) +
        tagOpen +
        selectedText +
        tagClose +
        editor.value.substring(endPos);

      editor.value = newText;
      editor.selectionStart = startPos + tagOpen.length;
      editor.selectionEnd = endPos + tagOpen.length;
      editor.focus();
    });
  });
}

setupEditorButtons();
