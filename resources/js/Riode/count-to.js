import Riode from "@/Riode/";

const moduleCountTo = function(selector) {
    if ($.fn.countTo) {
        Riode.$(selector).each(function() {
            Riode.appear(this, function() {
                var $this = $(this);
                setTimeout(function() {
                    $this.countTo({
                        onComplete: function() {
                            $this.addClass("complete");
                        }
                    });
                }, 300);
            });
        });
    }
};

export default moduleCountTo;
