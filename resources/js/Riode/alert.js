import Riode from "@/Riode/";

const moduleAlert = function(selector) {
  Riode.$body.on("click", selector + " .btn-close", function(e) {
      $(this)
          .closest(selector)
          .fadeOut(function() {
              $(this).remove();
          });
  });
};

export default moduleAlert