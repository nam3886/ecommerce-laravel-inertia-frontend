import Riode from "@/Riode/";

const moduleProductSingle = (function () {
    /**
     * @class ProductSingle
     */
    function ProductSingle($el) {
        return this.init($el);
    }

    var thumbsInit = function (self) {
        // members for thumbnails
        self.$thumbs = self.$wrapper.find(".product-thumbs");
        self.$thumbsWrap = self.$thumbs.parent();
        self.$thumbUp = self.$thumbsWrap.find(".thumb-up");
        self.$thumbDown = self.$thumbsWrap.find(".thumb-down");
        self.$thumbsDots = self.$thumbs.children();
        self.thumbsCount = self.$thumbsDots.length;
        self.$productThumb = self.$thumbsDots.eq(0);
        self._isPgvertical = self.$thumbsWrap.parent().hasClass("pg-vertical");
        self.thumbsIsVertical =
            self._isPgvertical && window.innerWidth >= Riode.minDesktopWidth;

        // register events
        self.$thumbDown.on("click", function (e) {
            self.thumbsIsVertical && thumbsDown(self);
        });

        self.$thumbUp.on("click", function (e) {
            self.thumbsIsVertical && thumbsUp(self);
        });

        self.$thumbsDots.on("click", function () {
            var $this = $(this),
                index = (
                    $this.parent().filter(self.$thumbs).length
                        ? $this
                        : $this.parent()
                ).index();
            self.$wrapper
                .find(".product-single-carousel")
                .trigger("to.owl.carousel", index);
        });

        // refresh thumbs
        thumbsRefresh(self);
        Riode.$window.on("resize", function () {
            thumbsRefresh(self);
        });
    };

    var thumbsDown = function (self) {
        var maxBottom =
                self.$thumbsWrap.offset().top +
                self.$thumbsWrap[0].offsetHeight,
            curBottom = self.$thumbs.offset().top + self.thumbsHeight;

        if (curBottom >= maxBottom + self.$productThumb[0].offsetHeight) {
            self.$thumbs.css(
                "top",
                parseInt(self.$thumbs.css("top")) -
                    self.$productThumb[0].offsetHeight
            );
            self.$thumbUp.removeClass("disabled");
        } else if (curBottom > maxBottom) {
            self.$thumbs.css(
                "top",
                parseInt(self.$thumbs.css("top")) -
                    Math.ceil(curBottom - maxBottom)
            );
            self.$thumbUp.removeClass("disabled");
            self.$thumbDown.addClass("disabled");
        } else {
            self.$thumbDown.addClass("disabled");
        }
    };

    var thumbsUp = function (self) {
        var maxTop = self.$thumbsWrap.offset().top,
            curTop = self.$thumbs.offset().top;

        if (curTop <= maxTop - self.$productThumb[0].offsetHeight) {
            self.$thumbs.css(
                "top",
                parseInt(self.$thumbs.css("top")) +
                    self.$productThumb[0].offsetHeight
            );
            self.$thumbDown.removeClass("disabled");
        } else if (curTop < maxTop) {
            self.$thumbs.css(
                "top",
                parseInt(self.$thumbs.css("top")) - Math.ceil(curTop - maxTop)
            );
            self.$thumbDown.removeClass("disabled");
            self.$thumbUp.addClass("disabled");
        } else {
            self.$thumbUp.addClass("disabled");
        }
    };

    var thumbsRefresh = function (self) {
        if (typeof self.$thumbs == "undefined") {
            return;
        }

        var oldIsVertical =
            "undefined" == typeof self.thumbsIsVertical
                ? false
                : self.thumbsIsVertical; // is vertical?
        self.thumbsIsVertical =
            self._isPgvertical && window.innerWidth >= Riode.minDesktopWidth;

        if (self.thumbsIsVertical) {
            // enable vertical product gallery thumbs.
            // disable thumbs carousel
            self.$thumbs.hasClass("owl-carousel") &&
                self.$thumbs
                    .trigger("destroy.owl.carousel")
                    .removeClass("owl-carousel");

            // enable thumbs vertical nav
            self.thumbsHeight =
                self.$productThumb[0].offsetHeight * self.thumbsCount +
                parseInt(self.$productThumb.css("margin-bottom")) *
                    (self.thumbsCount - 1);
            self.$thumbUp.addClass("disabled");
            self.$thumbDown.toggleClass(
                "disabled",
                self.thumbsHeight <= self.$thumbsWrap[0].offsetHeight
            );
            self.isQuickview && recalcDetailsHeight();
        } else {
            // if not vertical, remove top property
            oldIsVertical && self.$thumbs.css("top", "");

            // enable thumbs carousel
            self.$thumbs.hasClass("owl-carousel") ||
                self.$thumbs.addClass("owl-carousel").owlCarousel(
                    $.extend(
                        true,
                        self.isQuickview
                            ? {
                                  onInitialized: recalcDetailsHeight,
                                  onResized: recalcDetailsHeight,
                              }
                            : {},
                        Riode.defaults.sliderThumbs
                    )
                );
        }
    };

    // For only Quickview
    var recalcDetailsHeight = function () {
        var self = this;
        self.$wrapper
            .find(".product-details")
            .css(
                "height",
                window.innerWidth > 767
                    ? self.$wrapper.find(".product-gallery")[0].clientHeight
                    : ""
            );
    };

    // Public Properties

    ProductSingle.prototype.init = function ($el) {
        var self = this,
            $slider = $el.find(".product-single-carousel");

        // members
        self.$wrapper = $el;
        self.isQuickview = !!$el.closest(".mfp-content").length;
        self._isPgvertical = false;

        // bind
        if (self.isQuickview) {
            recalcDetailsHeight = recalcDetailsHeight.bind(this);
            Riode.ratingTooltip();
        }

        // init thumbs
        $slider
            .on("initialized.owl.carousel", function (e) {
                // init thumbnails
                thumbsInit(self);
            })
            .on("translate.owl.carousel", function (e) {
                var currentIndex =
                    (e.item.index -
                        $(e.currentTarget).find(".cloned").length / 2 +
                        e.item.count) %
                    e.item.count;
                self.thumbsSetActive(currentIndex);
            });

        // if this is created after document ready, init plugins
        if ("complete" === Riode.status) {
            Riode.slider($slider);
        }

        // if ( $slider.length == 0 ) {
        //     Riode.zoomImage( this.$wrapper );
        // }
    };

    ProductSingle.prototype.thumbsSetActive = function (index) {
        var self = this,
            $curThumb = self.$thumbsDots.eq(index);

        self.$thumbsDots.filter(".active").removeClass("active");
        $curThumb.addClass("active");

        // show current thumb
        if (self.thumbsIsVertical) {
            // if vertical
            var offset =
                parseInt(self.$thumbs.css("top")) + index * self.thumbsHeight;

            if (offset < 0) {
                // if above
                self.$thumbs.css(
                    "top",
                    parseInt(self.$thumbs.css("top")) - offset
                );
            } else {
                offset =
                    self.$thumbs.offset().top +
                    self.$thumbs[0].offsetHeight -
                    $curThumb.offset().top -
                    $curThumb[0].offsetHeight;

                if (offset < 0) {
                    // if below
                    self.$thumbs.css(
                        "top",
                        parseInt(self.$thumbs.css("top")) + offset
                    );
                }
            }
        } else {
            // if thumb carousel
            self.$thumbs.trigger("to.owl.carousel", index, 100);
        }
    };

    return function ($el, options) {
        if ($el) {
            return new ProductSingle($el.eq(0), options);
        }
        return null;
    };
})();

export default moduleProductSingle;
