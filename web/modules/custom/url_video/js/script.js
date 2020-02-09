(function ($, Drupal) {
  Drupal.behaviors.ajaxModal = {
    attach: function (context, settings) {
      var modal = document.getElementById("video-insta-if");
      var btn = document.getElementById("insta-button");
      var span = document.getElementsByClassName("close")[0];

      btn.onclick = function() {
        modal.style.display = "block";
      }

      span.onclick = function() {
        modal.style.display = "none";
      }

      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }

      $(document).ready(function(){
        $("#click-prev").click(function(){
          $("#video-with-prev").show();
          $("#click-prev").hide();
        });
      });
    }
  };
})(jQuery, Drupal);
