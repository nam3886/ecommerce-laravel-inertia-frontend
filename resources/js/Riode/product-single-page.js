import Riode from "@/Riode/";
import PhotoSwipe from "@p/vendor/photoswipe/photoswipe.min.js";
import PhotoSwipeUI_Default from "@p/vendor/photoswipe/photoswipe-ui-default.min.js";

const moduleProductSinglePage = (function () {
    function ratingForm() {
        Riode.$body.on("click", ".rating-form .rating-stars > a", function (e) {
            var $star = $(this);
            $star.addClass("active").siblings().removeClass("active");
            $star.parent().addClass("selected");
            $star.closest(".rating-form").find("select").val($star.text());
            e.preventDefault();
        });
    }
    function initWishlistAction(e) {
        var $this = $(e.currentTarget);
        if ($this.hasClass("added")) {
            return;
        }
        e.preventDefault();
        $this.addClass("load-more-overlay loading");

        setTimeout(function () {
            $this
                .removeClass("load-more-overlay loading")
                .html('<i class="d-icon-heart-full"></i> Browse wishlist')
                .addClass("added")
                .attr("title", "Browse wishlist")
                .attr("href", "wishlist.html");
        }, 500);
    }

    // Public Properties
    return function (selector) {
        var $product = $(selector);

        // Wishlist button
        Riode.$body.on(
            "click",
            ".product-single .btn-wishlist",
            initWishlistAction
        );

        if ($product.length) {
            // if home page, init single products
            if (document.body.classList.contains("home")) {
                $product.each(function () {
                    Riode.initProductSingle($(this));
                });

                return null;

                // else, init single product page
            } else {
                if (Riode.initProductSingle($product) === null) {
                    return null;
                }
            }
        } else {
            // if no single product exists, return
            return null;
        }

        // image zoom for grid type
        Riode.zoomImage(".product-gallery.row");

        // init rating from.(new)
        ratingForm();
    };
})();

export default moduleProductSinglePage;
