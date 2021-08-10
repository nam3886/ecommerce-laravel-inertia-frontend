import Riode from "@/Riode/";

const moduleTab = function(selector) {
    Riode.$body
        // tab nav link
        .on("click", ".tab .nav-link", function(e) {
            var $this = $(this);
            e.preventDefault();

            if (!$this.hasClass("active")) {
                var $panel = $($this.attr("href"));
                $panel.siblings().removeClass("in active");
                $panel.addClass("active in");

                // owl-carousel init
                Riode.slider($panel.find(".owl-carousel"));

                $this
                    .parent()
                    .parent()
                    .find(".active")
                    .removeClass("active");
                $this.addClass("active");
            }
        })

        // link to tab
        .on("click", ".link-to-tab", function(e) {
            var selector = $(e.currentTarget).attr("href"),
                $tab = $(selector),
                $nav = $tab.parent().siblings(".nav");
            e.preventDefault();

            $tab.siblings().removeClass("active in");
            $tab.addClass("active in");
            $nav.find(".nav-link").removeClass("active");
            $nav.find('[href="' + selector + '"]').addClass("active");

            $("html").animate({
                scrollTop: $tab.offset().top - 150
            });
        });
};

export default moduleTab;
