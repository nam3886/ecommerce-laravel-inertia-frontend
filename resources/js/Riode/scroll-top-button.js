import Riode from "@/Riode/";

const moduleScrollTopButton = function() {
    // register scroll top button

    var domScrollTop = Riode.byId("scroll-top");

    if (domScrollTop) {
        domScrollTop.addEventListener("click", function(e) {
            $("html, body").animate({ scrollTop: 0 }, 600);
            e.preventDefault();
        });

        var refreshScrollTop = function() {
            if (window.pageYOffset > 400) {
                domScrollTop.classList.add("show");
            } else {
                domScrollTop.classList.remove("show");
            }
        };

        Riode.call(refreshScrollTop, 500);
        window.addEventListener("scroll", refreshScrollTop, {
            passive: true
        });
    }
};

export default moduleScrollTopButton;
