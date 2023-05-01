$(document).ready(function() {
  // Handler pour le bouton "like"
  $(".like-btn").click(function(e) {
      e.preventDefault();
      var commentId = $(this).attr("href").split("/").pop();
      var url = '{{ path("app_comment_like", {"id": "999"}) }}'.replace('999', commentId);
      $.ajax({
          url: url,
          method: "POST",
          success: function(response) {
              if (response.success) {
                  $("#comment-" + commentId + " .like-count").text(response.likes);
                  $("#comment-" + commentId + " .dislike-count").text(response.dislikes);
              } else {
                  alert(response.error);
              }
          },
          error: function() {
              alert("Une erreur s'est produite.");
          }
      });
  });

  // Handler pour le bouton "dislike"
  $(".dislike-btn").click(function(e) {
      e.preventDefault();
      var commentId = $(this).attr("href").split("/").pop();
      var url = '{{ path("app_comment_dislike", {"id": "999"}) }}'.replace('999', commentId);
      $.ajax({
          url: url,
          method: "POST",
          success: function(response) {
              if (response.success) {
                  $("#comment-" + commentId + " .like-count").text(response.likes);
                  $("#comment-" + commentId + " .dislike-count").text(response.dislikes);
              } else {
                  alert(response.error);
              }
          },
          error: function() {
              alert("Une erreur s'est produite.");
          }
      });
  });
  function updateLikes(commentId) {
    var url = '{{ path("update_likes") }}';
    var data = {commentId: commentId};

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function(response) {
            if (response.success) {
                $('#likes-' + commentId).text(response.likes);
                $('#dislikes-' + commentId).text(response.dislikes);
            } else {
                alert(response.error);
            }
        },
        error: function() {
            alert('Une erreur s\'est produite.');
        }
    });
}
});
