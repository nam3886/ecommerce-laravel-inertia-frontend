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
    function openFullImage(e) {
        e.preventDefault();

        var $this = $(e.currentTarget),
            $product = $this.closest(".product-single"),
            $images,
            images;

        if ($product.find(".product-single-carousel").length) {
            // single carousel
            $images = $product.find(
                ".product-single-carousel .owl-item:not(.cloned) img"
            );
        } else if ($product.find(".product-gallery-carousel").length) {
            // gallery carousel
            $images = $product.find(
                ".product-gallery-carousel .owl-item:not(.cloned) img"
            );
        } else {
            // simple gallery
            $images = $product.find(".product-gallery img");
        }

        // if images exist
        if ($images.length) {
            var images = $images
                    .map(function () {
                        var $this = $(this);

                        return {
                            src: $this.attr("data-zoom-image"),
                            w: 800,
                            h: 899,
                            title: $this.attr("alt"),
                        };
                    })
                    .get(),
                carousel = $product
                    .find(".product-single-carousel, .product-gallery-carousel")
                    .data("owl.carousel"),
                currentIndex = carousel
                    ? // Carousel Type
                      (carousel.current() -
                          carousel.clones().length / 2 +
                          images.length) %
                      images.length
                    : // Gallery Type
                      $product.find(".product-gallery > *").index();

            if (typeof PhotoSwipe !== "undefined") {
                var pswpElement = $(".pswp")[0];

                var photoswipe = new PhotoSwipe(
                    pswpElement,
                    PhotoSwipeUI_Default,
                    images,
                    {
                        index: currentIndex,
                        closeOnScroll: false,
                    }
                );
                photoswipe.init();
                Riode.photoswipe = photoswipe;
            }
        }
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

        // image full
        // Riode.$body.on(
        //     "click",
        //     ".product-single .product-image-full",
        //     openFullImage
        // );

        // init rating from.(new)
        ratingForm();
    };
})();

export default moduleProductSinglePage;
