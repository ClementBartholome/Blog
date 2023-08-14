function setupEditorButtons() {
  const editorButtons = document.querySelectorAll(".editor-button");
  const editor = document.querySelector(".editor");

  editorButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const startPos = editor.selectionStart;
      const endPos = editor.selectionEnd;
      const selectedText = editor.value.substring(startPos, endPos);
      const tag = button.getAttribute("data-tag");

      if (tag === "br") {
        const newText =
          editor.value.substring(0, startPos) +
          "<br>" +
          editor.value.substring(endPos);

        editor.value = newText;
        editor.selectionStart = startPos + 4;
        editor.selectionEnd = startPos + 4;
      } else {
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
      }

      editor.focus();
    });
  });
}

setupEditorButtons();
