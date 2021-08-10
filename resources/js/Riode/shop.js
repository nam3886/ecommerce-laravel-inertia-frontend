import Riode from "@/Riode/";

const moduleShop = {
    init: function() {
        // Functions for products
        this.initProductsCartAction();
        this.initProductsLoad();
        this.initProductsScrollLoad(".scroll-load");
        this.initProductType("slideup");
        this.initVariation();
        this.initWishlistButton(".product:not(.product-single) .btn-wishlist");
        Riode.call(Riode.ratingTooltip, 500);

        // Functions for shop page
        this.initSelectMenu(".select-menu");
        Riode.priceSlider(".filter-price-slider");
    },

    initVariation: function(type) {
        $(".product:not(.product-single) .product-variations > a").on(
            "click",
            function(e) {
                var $this = $(this),
                    $image = $this
                        .closest(".product")
                        .find(".product-media img");

                if (!$image.data("image-src"))
                    $image.data("image-src", $image.attr("src"));

                $this
                    .toggleClass("active")
                    .siblings()
                    .removeClass("active");
                if ($this.hasClass("active")) {
                    $image.attr("src", $this.data("src"));
                } else {
                    $image.attr("src", $image.data("image-src"));
                    $this.blur();
                }
                e.preventDefault();
            }
        );
    },

    initProductType: function(type) {
        // "slideup" type
        if (type === "slideup") {
            $(".product-slideup-content .product-details").each(function(e) {
                var $this = $(this),
                    hidden_height = $this
                        .find(".product-hide-details")
                        .outerHeight(true);

                $this.height($this.height() - hidden_height);
            });

            $(Riode.byClass("product-slideup-content"))
                .on("mouseenter touchstart", function(e) {
                    var $this = $(this),
                        hidden_height = $this
                            .find(".product-hide-details")
                            .outerHeight(true);

                    $this
                        .find(".product-details")
                        .css(
                            "transform",
                            "translateY(" + -hidden_height + "px)"
                        );
                    $this
                        .find(".product-hide-details")
                        .css(
                            "transform",
                            "translateY(" + -hidden_height + "px)"
                        );
                })
                .on("mouseleave touchleave", function(e) {
                    var $this = $(this),
                        hidden_height = $this
                            .find(".product-hide-details")
                            .outerHeight(true);

                    $this
                        .find(".product-details")
                        .css("transform", "translateY(0)");
                    $this
                        .find(".product-hide-details")
                        .css("transform", "translateY(0)");
                });
        }
    },

    initSelectMenu: function() {
        Riode.$body
            // open select menu
            .on("mousedown", ".select-menu", function(e) {
                var $selectMenu = $(e.currentTarget),
                    $target = $(e.target),
                    isOpened = $selectMenu.hasClass("opened");

                if ($selectMenu.hasClass("fixed")) {
                    e.stopPropagation();
                } else {
                    // close all select menu
                    $(".select-menu").removeClass("opened");
                }

                if ($selectMenu.is($target.parent())) {
                    // if toggle is clicked
                    isOpened || $selectMenu.addClass("opened");
                    e.stopPropagation();
                } else {
                    // if item is clicked
                    $target.parent().toggleClass("active");
                    if ($target.parent().hasClass("active")) {
                        // add select-item, and show
                        $(".select-items").show();
                        $(
                            '<a href="#" class="select-item">' +
                                $target.text() +
                                '<i class="d-icon-times"></i></a>'
                        )
                            .insertBefore(".select-items .filter-clean")
                            .hide()
                            .fadeIn()
                            .data("link", $target.parent()); // link to anchor's parent - li tag
                    } else {
                        // remove select-item
                        $(".select-items > .select-item")
                            .filter(function(i, el) {
                                return el.innerText == $target.text();
                            })
                            .fadeOut(function() {
                                $(this).remove();
                                // if only clean all button remains, // then hide select-items
                                if ($(".select-items").children().length < 2) {
                                    $(".select-items").hide();
                                }
                            });
                    }
                }
            })
            // Close select menu
            .on("mousedown", function(e) {
                $(".select-menu").removeClass("opened");
            })
            .on("click", ".select-menu a", function(e) {
                e.preventDefault();
            })

            // Remove all filters in navigation
            .on("click", ".select-items .filter-clean", function(e) {
                var $clean = $(this);
                $clean.siblings().each(function() {
                    var $link = $(this).data("link");
                    $link && $link.removeClass("active");
                });
                $clean.parent().fadeOut(function() {
                    $clean.siblings().remove();
                });
                e.preventDefault();
            })
            // Remove one filter in navigation
            .on("click", ".select-item i", function(e) {
                $(e.currentTarget)
                    .parent()
                    .fadeOut(function() {
                        var $this = $(this),
                            $link = $this.data("link");
                        $link && $link.toggleClass("active");
                        $this.remove();

                        // if only clean all button remains, then hide select-items
                        if ($(".select-items").children().length < 2) {
                            $(".select-items").hide();
                        }
                    });
                e.preventDefault();
            })
            // Remove all filters
            .on("click", ".filter-clean", function(e) {
                $(".shop-sidebar .filter-items .active").removeClass("active");
                e.preventDefault();
            })
            // Toggle filter
            .on("click", ".filter-items a", function(e) {
                var $ul = $(this).closest(".filter-items");
                if (
                    !$ul.hasClass("search-ul") &&
                    !$ul.parent().hasClass("select-menu")
                ) {
                    if ($ul.hasClass("filter-price")) {
                        $(this)
                            .parent()
                            .siblings()
                            .removeClass("active");
                        $(this)
                            .parent()
                            .toggleClass("active");
                        e.preventDefault();
                    } else {
                        $(this)
                            .parent()
                            .toggleClass("active");
                        e.preventDefault();
                    }
                }
            });
    },

    initProductsCartAction: function() {
        Riode.$body
            // Cart dropdown is offcanvas type
            .on("click", ".cart-offcanvas .cart-toggle", function(e) {
                $(".cart-dropdown").addClass("opened");
                e.preventDefault();
            })
            .on("click", ".cart-offcanvas .cart-header .btn-close", function(
                e
            ) {
                $(".cart-dropdown").removeClass("opened");
                e.preventDefault();
            })
            .on("click", ".cart-offcanvas .cart-overlay", function(e) {
                $(".cart-dropdown").removeClass("opened");
                e.preventDefault();
            });
    },
    initProductsLoad: function() {
        $(".btn-load").on("click", function(e) {
            var $this = $(this),
                $wrapper = $($this.data("load-to")),
                loadText = $this.html();

            $this.text("Loading ...");
            $this.addClass("btn-loading");
            $(".d-loading").css("display", "block");
            e.preventDefault();

            $.ajax({
                url: $this.attr("href"),
                success: function(result) {
                    var $newItems = $(result);

                    setTimeout(function() {
                        $wrapper.isotope("insert", $newItems);
                        $this.html(loadText);

                        var loadCount = parseInt(
                            $this.data("load-count")
                                ? $this.data("load-count")
                                : 0
                        );
                        $this.data("load-count", ++loadCount);

                        //remove loading class
                        $this.removeClass("btn-loading");
                        $(".d-loading").css("display", "none");

                        // do not load more than 2 times
                        loadCount >= 2 && $this.hide();
                    }, 350);
                },
                failure: function() {
                    $this.text("Sorry something went wrong.");
                }
            });
        });
    },
    initProductsScrollLoad: function($obj) {
        var $wrapper = Riode.$($obj),
            top;
        var url = $($obj).data("url");
        if (!url) {
            url = "ajax/ajax-products.html";
        }
        var loadProducts = function(e) {
            if (
                window.pageYOffset >
                    top + $wrapper.outerHeight() - window.innerHeight - 150 &&
                "loading" != $wrapper.data("load-state")
            ) {
                $.ajax({
                    url: url,
                    success: function(result) {
                        var $newItems = $(result);
                        $wrapper.data("load-state", "loading");
                        if (!$wrapper.next().hasClass("load-more-overlay")) {
                            $(
                                '<div class="mt-4 mb-4 load-more-overlay loading"></div>'
                            ).insertAfter($wrapper);
                        } else {
                            $wrapper.next().addClass("loading");
                        }
                        setTimeout(function() {
                            $wrapper.next().removeClass("loading");
                            $wrapper.append($newItems);
                            setTimeout(function() {
                                $wrapper
                                    .find(".product-wrap.fade:not(.in)")
                                    .addClass("in");
                            }, 200);
                            $wrapper.data("load-state", "loaded");
                        }, 500);
                        var loadCount = parseInt(
                            $wrapper.data("load-count")
                                ? $wrapper.data("load-count")
                                : 0
                        );
                        $wrapper.data("load-count", ++loadCount);
                        loadCount > 2 &&
                            window.removeEventListener("scroll", loadProducts, {
                                passive: true
                            });
                    },
                    failure: function() {
                        $this.text("Sorry something went wrong.");
                    }
                });
            }
        };
        if ($wrapper.length > 0) {
            top = $wrapper.offset().top;
            window.addEventListener("scroll", loadProducts, {
                passive: true
            });
        }
    },
    initWishlistButton: function(selector) {
        Riode.$body.on("click", selector, function(e) {
            var $this = $(this);
            $this.toggleClass("added").addClass("load-more-overlay loading");

            setTimeout(function() {
                $this
                    .removeClass("load-more-overlay loading")
                    .find("i")
                    .toggleClass("d-icon-heart")
                    .toggleClass("d-icon-heart-full");

                if ($this.hasClass("added")) {
                    $this.attr("title", "Remove from wishlist");
                } else {
                    $this.attr("title", "Add to wishlist");
                }
            }, 500);

            e.preventDefault();
        });
    }
};

export default moduleShop;
