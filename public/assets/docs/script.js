(function($) {
  'use strict';

  $('body').scrollspy({ target: '#sidebarNav' })
  function qsa(sel) {
      return Array.apply(null, document.querySelectorAll(sel));
  }
  qsa(".code-editable").forEach(function (editorEl) {
    CodeMirror.fromTextArea(editorEl, {
      theme: "dracula",
      lineNumbers: true
    });
  });
  qsa(".code-non-editable").forEach(function (editorEl) {
      CodeMirror.fromTextArea(editorEl, {
        mode: "javascript",
        theme: "xq-light",
        lineNumbers: false,
        readOnly: true,
        maxHighlightLength: 0,
        workDelay: 0
      });
    });     
})(jQuery);    