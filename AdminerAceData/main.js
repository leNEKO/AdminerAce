var options = {
  fontFamily: "Fira code",
  fontSize: "###fs###",
  displayIndentGuides: true,
  enableBasicAutocompletion: true,
  enableLiveAutocompletion: true,
  showPrintMargin: false
};

$(function() {
  ace.require("ace/ext/language_tools");

  $(".sqlarea.jush").remove();
  $(".sqlarea")
    // .not(".jush-sql")
    .each(function() {
      var textarea = $(this);

      var editDiv = $("<pre>", {
        position: "absolute",
        // width: textarea.width(),
        height: textarea.height(),
        class: textarea.attr("class")
      }).insertBefore(textarea);

      textarea.css({
        visibility: "hidden",
        position: "fixed",
        width: 0,
        height: 0,
        top: 0,
        left: 0
      });

      var editor = ace.edit(editDiv[0]);

      // editor.renderer.setShowGutter(false);
      editor.setOptions(options);
      editor.getSession().setValue(textarea.val());
      editor.getSession().setMode("ace/mode/mysql");
      editor.setTheme("ace/theme/###theme###");

      // copy back to textarea on form submit...
      textarea.closest("form").on("keyup", function() {
        textarea.val(editor.getSession().getValue());
      });
    });
});
