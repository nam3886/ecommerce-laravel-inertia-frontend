import Riode from "@/Riode/";

const moduleAccordion = function(selector) {
    Riode.$body.on("click", selector, function(e) {
        var $this = $(this),
            $header = $this,
            $body = $this.closest(".card").find($this.attr("href")),
            $parent = $this.closest(".accordion");

        e.preventDefault();

        if (
            0 === $parent.find(".collapsing").length &&
            0 === $parent.find(".expanding").length
        ) {
            if ($body.hasClass("expanded")) {
                if (!$parent.hasClass("radio-type")) slideToggle($body);
            } else if ($body.hasClass("collapsed")) {
                if ($parent.find(".expanded").length > 0) {
                    if (Riode.isIE) {
                        slideToggle($parent.find(".expanded"), function() {
                            slideToggle($body);
                        });
                    } else {
                        slideToggle($parent.find(".expanded"));
                        slideToggle($body);
                    }
                } else {
                    slideToggle($body);
                }
            }
        }
    });

    // define slideToggle method
    var slideToggle = function($wrap, callback) {
        var $header = $wrap.closest(".card").find(selector);

        if ($wrap.hasClass("expanded")) {
            $header.removeClass("collapse").addClass("expand");
            $wrap.addClass("collapsing").slideUp(300, function() {
                $wrap.removeClass("expanded collapsing").addClass("collapsed");
                callback && callback();
            });
        } else if ($wrap.hasClass("collapsed")) {
            $header.removeClass("expand").addClass("collapse");
            $wrap.addClass("expanding").slideDown(300, function() {
                $wrap.removeClass("collapsed expanding").addClass("expanded");
                callback && callback();
            });
        }
    };
};

export default moduleAccordion;
