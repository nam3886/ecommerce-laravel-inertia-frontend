import Riode from "@/Riode/";

const moduleAppearAnimate = function(selector) {
    Riode.$(selector).each(function() {
        var el = this;
        Riode.appear(el, function() {
            if (el.classList.contains("appear-animate")) {
                var settings = $.extend(
                    {},
                    Riode.defaults.animation,
                    Riode.parseOptions(
                        el.getAttribute("data-animation-options")
                    )
                );

                Riode.call(function() {
                    setTimeout(
                        function() {
                            el.style["animation-duration"] = settings.duration;
                            el.classList.add(settings.name);
                            el.classList.add("appear-animation-visible");
                        },
                        settings.delay
                            ? Number(settings.delay.slice(0, -1)) * 1000
                            : 0
                    );
                });
            }
        });
    });
};

export default moduleAppearAnimate;
