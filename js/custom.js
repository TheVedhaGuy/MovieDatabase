$(function() {

  $("#signout").click(function() {
    $.ajax({
        url: "././core/destroysession.php",
        type: "POST",
      })
  });

});
