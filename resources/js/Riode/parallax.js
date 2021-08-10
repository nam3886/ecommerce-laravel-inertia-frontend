import Riode from "@/Riode/";

const moduleParallax = function(selector, options) {
    if ($.fn.themePluginParallax) {
        Riode.$(selector).each(function() {
            var $this = $(this);
            $this.themePluginParallax(
                $.extend(
                    true,
                    Riode.parseOptions($this.attr("data-parallax-options")),
                    options
                )
            );
        });
    }
};

export default moduleParallax;
