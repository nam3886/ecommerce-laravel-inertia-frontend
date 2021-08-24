/**
 * Riode Main Javascript File
 */
"use strict";

import "@p/vendor/sticky/sticky.min.js";
import "@p/vendor/elevatezoom/jquery.elevatezoom.min.js";
import "@p/vendor/parallax/parallax.min.js";
import "@p/vendor/imagesloaded/imagesloaded.pkgd.min.js";
import "@p/vendor/owl-carousel/owl.carousel.min.js";
import "@p/vendor/magnific-popup/jquery.magnific-popup.min.js";
import "@p/vendor/jquery.plugin/jquery.plugin.min.js";
import "@p/vendor/jquery.countdown/jquery.countdown.min.js";

import moduleCountdown from "@/Riode/countdown.js";
import moduleScrollTopButton from "@/Riode/scroll-top-button.js";
import moduleAppearAnimate from "@/Riode/appear-animate.js";
import moduleHeaderToggleSearch from "@/Riode/header-toggle-search.js";
import moduleCountTo from "@/Riode/count-to.js";
import modulePlayableVideo from "@/Riode/playable-video.js";
import moduleParallax from "@/Riode/parallax.js";
import moduleCloseTopNotice from "@/Riode/close-top-notice.js";
import moduleStickyContent from "@/Riode/sticky-content.js";
import moduleAccordion from "@/Riode/accordion.js";
import moduleTab from "@/Riode/tab.js";
import moduleAlert from "@/Riode/alert.js";
import modulePopup from "@/Riode/popup.js";
import moduleZoom from "@/Riode/zoom.js";
import moduleFloatSVG from "@/Riode/float-svg.js";
import moduleMenu from "@/Riode/menu.js";
import moduleProductSingle from "@/Riode/product-single.js";
import moduleProductSinglePage from "@/Riode/product-single-page.js";
import moduleShop from "@/Riode/shop.js";

/* jQuery easing */
$.extend($.easing, {
    def: "easeOutQuad",
    swing: function (x, t, b, c, d) {
        return $.easing[$.easing.def](x, t, b, c, d);
    },
    easeOutQuad: function (x, t, b, c, d) {
        return -c * (t /= d) * (t - 2) + b;
    },
    easeOutQuint: function (x, t, b, c, d) {
        return c * ((t = t / d - 1) * t * t * t * t + 1) + b;
    },
});

/**
 * Riode Object
 */
const Riode = {};

// Riode Properties
Riode.$route = route().t.url;
Riode.$window = $(window);
Riode.$body = $(document.body);
Riode.status = ""; // Riode Status
Riode.minDesktopWidth = 992; // Detect desktop screen
Riode.isIE = navigator.userAgent.indexOf("Trident") >= 0; // Detect Internet Explorer
Riode.isEdge = navigator.userAgent.indexOf("Edge") >= 0; // Detect Edge
Riode.isMobile =
    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
        navigator.userAgent
    ); // Detect Mobile
Riode.defaults = {
    animation: {
        name: "fadeIn",
        duration: "1.2s",
        delay: ".2s",
    },
    isotope: {
        itemsSelector: ".grid-item",
        layoutMode: "masonry",
        percentPosition: true,
        masonry: {
            columnWidth: ".grid-space",
        },
    },
    popup: {
        removalDelay: 350,
        callbacks: {
            open: function () {
                $("html").css("overflow-y", "hidden");
                $("body").css("overflow-x", "visible");
                $(".mfp-wrap").css("overflow", "hidden auto");
                $(".sticky-header.fixed").css(
                    "padding-right",
                    window.innerWidth - document.body.clientWidth
                );
            },
            close: function () {
                $("html").css("overflow-y", "");
                $("body").css("overflow-x", "hidden");
                $(".mfp-wrap").css("overflow", "");
                $(".sticky-header.fixed").css("padding-right", "");
            },
        },
    },
    popupPresets: {
        login: {
            type: "ajax",
            mainClass: "mfp-login mfp-fade",
            tLoading: "",
            preloader: false,
        },
        video: {
            type: "iframe",
            mainClass: "mfp-fade",
            preloader: false,
            closeBtnInside: false,
        },
        quickview: {
            type: "ajax",
            mainClass: "mfp-product mfp-fade",
            tLoading: "",
            preloader: false,
        },
    },
    slider: {
        responsiveClass: true,
        navText: [
            '<i class="d-icon-angle-left">',
            '<i class="d-icon-angle-right">',
        ],
        checkVisible: false,
        items: 1,
        smartSpeed: Riode.isEdge ? 200 : 500,
        autoplaySpeed: Riode.isEdge ? 200 : 1000,
        autoplayTimeout: 10000,
    },
    sliderPresets: {
        "intro-slider": {
            animateIn: "fadeIn",
            animateOut: "fadeOut",
        },
        "product-single-carousel": {
            dots: false,
            nav: true,
        },
        "product-gallery-carousel": {
            dots: false,
            nav: true,
            margin: 20,
            items: 1,
            responsive: {
                576: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
            },
        },
        "rotate-slider": {
            dots: false,
            nav: true,
            margin: 0,
            items: 1,
            animateIn: "",
            animateOut: "",
        },
    },
    sliderThumbs: {
        margin: 0,
        items: 4,
        dots: false,
        nav: true,
        navText: [
            '<i class="fas fa-chevron-left">',
            '<i class="fas fa-chevron-right">',
        ],
    },
    stickyContent: {
        minWidth: Riode.minDesktopWidth,
        maxWidth: 20000,
        top: 300,
        hide: false, // hide when it is not sticky.
        max_index: 1060, // maximum z-index of sticky contents
        scrollMode: false,
    },
    stickyHeader: {
        // activeScreenWidth: Riode.minDesktopWidth
        activeScreenWidth: 768,
    },
    stickyFooter: {
        minWidth: 0,
        maxWidth: 767,
        top: 150,
        hide: true,
        scrollMode: true,
    },
    stickyToolbox: {
        minWidth: 0,
        maxWidth: 767,
        top: false,
        scrollMode: true,
    },
    stickySidebar: {
        autoInit: true,
        minWidth: 991,
        containerSelector: ".sticky-sidebar-wrapper",
        autoFit: true,
        activeClass: "sticky-sidebar-fixed",
        paddingOffsetTop: 93,
        paddingOffsetBottom: 0,
    },
    templateCartAddedAlert:
        '<div class="alert alert-simple alert-btn cart-added-alert">' +
        '<a href="cart.html" class="btn btn-success btn-md">View Cart</a>' +
        '<span>"{{name}}" has been added to your cart.</span>' +
        '<button type="button" class="btn btn-link btn-close"><i class="d-icon-times"></i></button>' +
        "</div>",
    zoomImage: {
        responsive: true,
        zoomWindowFadeIn: 750,
        zoomWindowFadeOut: 500,
        borderSize: 0,
        zoomType: "inner",
        cursor: "crosshair",
    },
};

/**
 * Get jQuery object
 * @param {string|jQuery} selector
 */
Riode.$ = function (selector) {
    return selector instanceof jQuery ? selector : $(selector);
};

/**
 * Make a macro task
 * @param {function} fn
 * @param {number} delay
 */
Riode.call = function (fn, delay) {
    setTimeout(fn, delay);
};

/**
 * Get dom element by id
 * @param {string} id
 */
Riode.byId = function (id) {
    return document.getElementById(id);
};

/**
 * Get dom elements by tagName
 * @param {string} tagName
 * @param {HTMLElement} element this can be omitted.
 */
Riode.byTag = function (tagName, element) {
    return element
        ? element.getElementsByTagName(tagName)
        : document.getElementsByTagName(tagName);
};

/**
 * Get dom elements by className
 * @param {string} className
 * @param {HTMLElement} element this can be omitted.
 */
Riode.byClass = function (className, element) {
    return element
        ? element.getElementsByClassName(className)
        : document.getElementsByClassName(className);
};

/**
 * Set cookie
 * @param {string} name Cookie name
 * @param {string} value Cookie value
 * @param {number} exdays Expire period
 */
Riode.setCookie = function (name, value, exdays) {
    var date = new Date();
    date.setTime(date.getTime() + exdays * 24 * 60 * 60 * 1000);
    document.cookie =
        name + "=" + value + ";expires=" + date.toUTCString() + ";path=/";
};

/**
 * Get cookie
 * @param {string} name Cookie name
 */
Riode.getCookie = function (name) {
    var n = name + "=";
    var ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; ++i) {
        var c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(n) == 0) {
            return c.substring(n.length, c.length);
        }
    }
    return "";
};

/**
 * Parse options string to object
 * @param {string} options
 */
Riode.parseOptions = function (options) {
    return "string" == typeof options
        ? JSON.parse(options.replace(/'/g, '"').replace(";", ""))
        : {};
};

/**
 * Parse html template with variables.
 * @param {string} template
 * @param {object} vars
 */
Riode.parseTemplate = function (template, vars) {
    return template.replace(/\{\{(\w+)\}\}/g, function () {
        return vars[arguments[1]];
    });
};

/**
 * @function isOnScreen
 * @param {HTMLElement} el
 * @param {number} dx
 * @param {number} dy
 */
Riode.isOnScreen = function (el, dx, dy) {
    var a = window.pageXOffset,
        b = window.pageYOffset,
        o = el.getBoundingClientRect(),
        x = o.left + a,
        y = o.top + b,
        ax = typeof dx == "undefined" ? 0 : dx,
        ay = typeof dy == "undefined" ? 0 : dy;

    return (
        y + o.height + ay >= b &&
        y <= b + window.innerHeight + ay &&
        x + o.width + ax >= a &&
        x <= a + window.innerWidth + ax
    );
};

/**
 * @function appear
 *
 * @param {HTMLElement} el
 * @param {function} fn
 * @param {object} options
 */
Riode.appear = (function () {
    var checks = [],
        timerId = false,
        one;

    var checkAll = function () {
        for (var i = checks.length; i--; ) {
            one = checks[i];

            if (Riode.isOnScreen(one.el, one.options.accX, one.options.accY)) {
                typeof $(one.el).data("appear-callback") == "function" &&
                    $(one.el).data("appear-callback").call(one.el, one.data);
                one.fn && one.fn.call(one.el, one.data);
                checks.splice(i, 1);
            }
        }
    };

    window.addEventListener("scroll", checkAll, { passive: true });
    window.addEventListener("resize", checkAll, { passive: true });
    $(window).on("appear.check", checkAll);

    return function (el, fn, options) {
        var settings = {
            data: undefined,
            accX: 0,
            accY: 0,
        };

        if (options) {
            options.data && (settings.data = options.data);
            options.accX && (settings.accX = options.accX);
            options.accY && (settings.accY = options.accY);
        }

        checks.push({ el: el, fn: fn, options: settings });
        if (!timerId) {
            timerId = Riode.requestTimeout(checkAll, 100);
        }
    };
})();

Riode.zoomImageObjects = [];
/**
 * @function zoomImage
 *
 * @requires elevateZoom
 * @param {string|jQuery} selector
 */
Riode.zoomImage = function (selector) {
    if ($.fn.elevateZoom && selector) {
        Riode.$(selector)
            .find("img")
            .each(function () {
                var $this = $(this);
                Riode.defaults.zoomImage.zoomContainer = $this.parent();
                $this.elevateZoom(Riode.defaults.zoomImage);
                Riode.zoomImageObjects.push($this);
            });
    }
};

/**
 * @function initZoom
 */
Riode.initZoom = moduleZoom;

/**
 * use in about page
 * @function countTo
 *
 * @requires jQuery.countTo
 * @param {string} selector
 */
Riode.countTo = moduleCountTo;

/**
 * @function countdown
 *
 * @requires jquery-countdown
 * @param {string} selector
 */
Riode.countdown = moduleCountdown;

/**
 * @function priceSlider
 *
 * @requires noUiSlider
 * @param {string} selector
 * @param {object} option
 */
Riode.priceSlider = function (selector, option) {
    if (typeof noUiSlider === "object") {
        Riode.$(selector).each(function () {
            var self = this;

            noUiSlider.create(
                self,
                $.extend(
                    true,
                    {
                        start: [18, 35],
                        connect: true,
                        step: 1,
                        range: {
                            min: 18,
                            max: 35,
                        },
                    },
                    option
                )
            );

            // Update Price Range
            self.noUiSlider.on("update", function (values, handle) {
                var values = values.map(function (value) {
                    return "$" + parseInt(value);
                });
                $(self)
                    .parent()
                    .find(".filter-price-range")
                    .text(values.join(" - "));
            });
        });
    }
};

Riode.lazyload = function (selector, force) {
    function load() {
        this.setAttribute("src", this.getAttribute("data-src"));
        this.addEventListener("load", function () {
            this.style["padding-top"] = "";
            this.classList.remove("lazy-img");
        });
    }

    // Lazyload images
    Riode.$(selector)
        .find(".lazy-img")
        .each(function () {
            if ("undefined" != typeof force && force) {
                load.call(this);
            } else {
                Riode.appear(this, load);
            }
        });
};

/**
 * @function isotopes
 *
 * @requires isotope,imagesLoaded
 * @param {string} selector
 * @param {object} options
 */
Riode.isotopes = function (selector, options) {
    if (typeof imagesLoaded === "function" && $.fn.isotope) {
        var self = this;

        Riode.$(selector).each(function () {
            var $this = $(this),
                settings = $.extend(
                    true,
                    {},
                    Riode.defaults.isotope,
                    Riode.parseOptions($this.attr("data-grid-options")),
                    options ? options : {}
                );

            Riode.lazyload($this);
            $this.imagesLoaded(function () {
                settings.customInitHeight && $this.height($this.height());
                settings.customDelay &&
                    Riode.call(function () {
                        $this.isotope(settings);
                    }, parseInt(settings.customDelay));

                $this.isotope(settings);
            });
        });
    }
};

/**
 * @function initNavFilter
 *
 * @requires isotope
 * @param {string} selector
 */
Riode.initNavFilter = function (selector) {
    if ($.fn.isotope) {
        Riode.$(selector).on("click", function (e) {
            var $this = $(this),
                filterValue = $this.attr("data-filter"),
                filterTarget = $this.parent().parent().attr("data-target");
            (filterTarget ? $(filterTarget) : $(".grid"))
                .isotope({ filter: filterValue })
                .isotope("on", "arrangeComplete", function () {
                    Riode.$window.trigger("appear.check");
                });
            $this.parent().siblings().children().removeClass("active");
            $this.addClass("active");
            e.preventDefault();
        });
    }
};

/**
 * @function initShowVendorSearch
 *
 * @param {string} selector
 */
Riode.initShowVendorSearch = function (selector) {
    Riode.$body.on("click", selector, function (e) {
        var $this = $(this),
            $formWrapper = $this.closest(".toolbox").next(".form-wrapper");

        if (!$formWrapper.hasClass("open")) {
            $formWrapper.slideDown().addClass("open");
        } else {
            $formWrapper.slideUp().removeClass("open");
        }
        e.preventDefault();
    });
};

/**
 * @function parallax
 * Initialize Parallax Background
 * @requires themePluginParallax
 * @param {string} selector
 */
Riode.parallax = moduleParallax;

/**
 * @function headerToggleSearch
 * Init header toggle search.
 * @param {string} selector
 */

Riode.headerToggleSearch = moduleHeaderToggleSearch;

/**
 * @function closeTopNotice
 * Init header toggle search.
 * @param {string} selector
 */

Riode.closeTopNotice = moduleCloseTopNotice;

/**
 * @function stickyHeader
 * Init sticky header
 * @param {string} selector
 */
Riode.stickyHeader = function (selector) {
    var $stickyHeader = Riode.$(selector);
    if ($stickyHeader.length == 0) return;

    var height,
        top,
        isWrapped = false;

    // define wrap function
    var stickyHeaderWrap = function () {
        height = $stickyHeader[0].offsetHeight;
        top = $stickyHeader.offset().top + height;

        // if sticky header has category dropdown, increase top
        if ($stickyHeader.hasClass("has-dropdown")) {
            var $box = $stickyHeader.find(".category-dropdown .dropdown-box");

            if ($box.length) {
                top += $stickyHeader.find(".category-dropdown .dropdown-box")[0]
                    .offsetHeight;
            }
        }

        // wrap sticky header
        if (
            !isWrapped &&
            window.innerWidth >= Riode.defaults.stickyHeader.activeScreenWidth
        ) {
            isWrapped = true;
            $stickyHeader.wrap(
                '<div class="sticky-wrapper" style="height:' +
                    height +
                    'px"></div>'
            );
        }

        Riode.$window.off("resize", stickyHeaderWrap);
    };

    // define refresh function
    var stickyHeaderRefresh = function () {
        var isFixed =
            window.innerWidth >=
                Riode.defaults.stickyHeader.activeScreenWidth &&
            window.pageYOffset >= top;

        // fix or unfix
        if (isFixed) {
            $stickyHeader[0].classList.add("fixed");
            document.body.classList.add("sticky-header-active");
        } else {
            $stickyHeader[0].classList.remove("fixed");
            document.body.classList.remove("sticky-header-active");
        }
    };

    // register events
    window.addEventListener("scroll", stickyHeaderRefresh, {
        passive: true,
    });
    Riode.$window.on("resize", stickyHeaderWrap);
    Riode.$window.on("resize", stickyHeaderRefresh);

    // init
    Riode.call(stickyHeaderWrap, 500);
    Riode.call(stickyHeaderRefresh, 500);
};

/**
 * @function stickyContent
 * Init Sticky Content
 * @param {string, Object} selector
 * @param {Object} settings
 */
Riode.stickyContent = moduleStickyContent;

/**
 * @function alert
 * Register events for alert
 * @param {string} selector
 */
Riode.initAlert = moduleAlert;

/**
 * @function accordion
 * Register events for accordion
 * @param {string} selector
 */
Riode.initAccordion = moduleAccordion;

/**
 * @function tab
 * Register events for tab
 * @param {string} selector
 */
Riode.initTab = moduleTab;

/**
 * @function playableVideo
 *
 * @param {string} selector
 */
Riode.playableVideo = modulePlayableVideo;

/**
 * @function appearAnimate
 *
 * @param {string} selector
 */
Riode.appearAnimate = moduleAppearAnimate;

/**
 * @function stickySidebar
 *
 * @requires themeSticky
 * @param {string} selector
 */
Riode.stickySidebar = function (selector) {
    if ($.fn.themeSticky) {
        Riode.$(selector).each(function () {
            var $this = $(this);
            $this.themeSticky(
                $.extend(
                    Riode.defaults.stickySidebar,
                    Riode.parseOptions($this.attr("data-sticky-options"))
                )
            );
            $this.trigger("recalc.pin");
        });
    }
};
/**
 * @function refreshSidebar
 *
 * @param {string} selector
 */
Riode.refreshSidebar = function (selector) {
    if ($.fn.themeSticky) {
        Riode.$(selector).each(function () {
            $(this).trigger("recalc.pin");
        });
    }
};

/**
 * @function ratingTooltip
 * Find all .ratings-full from root, and initialize tooltip.
 *
 * @param {HTMLElement} root
 */
Riode.ratingTooltip = function (root) {
    var els = Riode.byClass("ratings-full", root ? root : document.body),
        len = els.length;

    var ratingHandler = function () {
        var res =
            parseInt(this.firstElementChild.style.width.slice(0, -1)) / 20;
        this.lastElementChild.innerText = res ? res.toFixed(2) : res;
    };
    for (var i = 0; i < len; ++i) {
        els[i].addEventListener("mouseover", ratingHandler);
        els[i].addEventListener("touchstart", ratingHandler);
    }
};

/**
 * @function popup
 * @requires magnificPopup
 * @params {object} options
 * @params {string|undefined} preset
 */
Riode.popup = function (options, preset) {
    var mpInstance = $.magnificPopup.instance,
        opt = $.extend(
            true,
            {},
            Riode.defaults.popup,
            "undefined" != typeof preset
                ? Riode.defaults.popupPresets[preset]
                : {},
            options
        );

    // if something is already opened ( except login popup )
    if (mpInstance.isOpen && mpInstance.content) {
        mpInstance.close(); // close current
        setTimeout(function () {
            // and open new after a moment
            $.magnificPopup.open(opt);
        }, 500);
    } else {
        $.magnificPopup.open(opt); // if nothing is opened, open new
    }
};

/**
 * @function initPopups
 */
Riode.initPopups = modulePopup;

/**
 * @function initScrollTopButton
 */
Riode.initScrollTopButton = moduleScrollTopButton;

/**
 * @function requestTimeout
 * @param {function} fn
 * @param {number} delay
 */
Riode.requestTimeout = function (fn, delay) {
    var handler =
        window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame;
    if (!handler) {
        return setTimeout(fn, delay);
    }
    var start,
        rt = new Object();

    function loop(timestamp) {
        if (!start) {
            start = timestamp;
        }
        var progress = timestamp - start;
        progress >= delay ? fn() : (rt.val = handler(loop));
    }

    rt.val = handler(loop);
    return rt;
};

/**
 * @function requestInterval
 * @param {function} fn
 * @param {number} step
 * @param {number} timeOut
 */
Riode.requestInterval = function (fn, step, timeOut) {
    var handler =
        window.requestAnimationFrame ||
        window.webkitRequestAnimationFrame ||
        window.mozRequestAnimationFrame;
    if (!handler) {
        if (!timeOut) return setTimeout(fn, timeOut);
        else return setInterval(fn, step);
    }
    var start,
        last,
        rt = new Object();
    function loop(timestamp) {
        if (!start) {
            start = last = timestamp;
        }
        var progress = timestamp - start;
        var delta = timestamp - last;
        if (!timeOut || progress < timeOut) {
            if (delta > step) {
                rt.val = handler(loop);
                fn();
                last = timestamp;
            } else {
                rt.val = handler(loop);
            }
        } else {
            fn();
        }
    }
    rt.val = handler(loop);
    return rt;
};

/**
 * @function deleteTimeout
 * @param {number} timerID
 */
Riode.deleteTimeout = function (timerID) {
    if (!timerID) {
        return;
    }
    var handler =
        window.cancelAnimationFrame ||
        window.webkitCancelAnimationFrame ||
        window.mozCancelAnimationFrame;
    if (!handler) {
        return clearTimeout(timerID);
    }
    if (timerID.val) {
        return handler(timerID.val);
    }
};

/**
 * @function sidebar
 */
Riode.sidebar = (function () {
    var is_mobile = window.innerWidth < Riode.minDesktopWidth;
    var onResizeNavigationStyle = function () {
        if (window.innerWidth < Riode.minDesktopWidth && !is_mobile) {
            this.$sidebar
                .find(".sidebar-content, .filter-clean")
                .removeAttr("style");
            this.$sidebar.find(".sidebar-content").attr("style", "");
            this.$sidebar
                .siblings(".toolbox")
                .children(":not(:first-child)")
                .removeAttr("style");
        } else if (window.innerWidth >= Riode.minDesktopWidth) {
            if (!this.$sidebar.hasClass("closed") && is_mobile) {
                this.$sidebar.addClass("closed");
                this.$sidebar.find(".sidebar-content").css("display", "none");
            }
        }
        is_mobile = window.innerWidth < Riode.minDesktopWidth;
    };

    /**
     * @class Sidebar
     * Sidebar active class will be added to body tag : "sidebar class" + "-active"
     */
    function Sidebar(name) {
        return this.init(name);
    }

    Sidebar.prototype.init = function (name) {
        var self = this;

        self.name = name;
        self.$sidebar = $("." + name);
        self.isNavigation = false;

        // If sidebar exists
        if (self.$sidebar.length) {
            // check if navigation style
            self.isNavigation =
                self.$sidebar.hasClass("sidebar-fixed") &&
                self.$sidebar.parent().hasClass("toolbox-wrap");

            if (self.isNavigation) {
                onResizeNavigationStyle = onResizeNavigationStyle.bind(this);
                Riode.$window.on("resize", onResizeNavigationStyle);
            }

            Riode.$window.on("resize", function () {
                Riode.$body.removeClass(name + "-active");
            });

            // Register toggle event
            self.$sidebar
                .find(".sidebar-toggle, .sidebar-toggle-btn")
                .add(
                    name === "sidebar"
                        ? ".left-sidebar-toggle"
                        : "." + name + "-toggle"
                )
                .on("click", function (e) {
                    self.toggle();
                    $(this).blur();
                    $(".sticky-sidebar").trigger("recalc.pin.left", [400]);
                    e.preventDefault();
                });

            // Register close event
            self.$sidebar
                .find(".sidebar-overlay, .sidebar-close")
                .on("click", function (e) {
                    Riode.$body.removeClass(name + "-active");
                    $(".sticky-sidebar").trigger("recalc.pin.left", [400]);
                    e.preventDefault();
                });

            setTimeout(function () {
                $(".sticky-sidebar").trigger("recalc.pin", [400]);
            });
        }
        return false;
    };

    Sidebar.prototype.toggle = function () {
        var self = this;

        // if fixed sidebar
        if (
            window.innerWidth >= Riode.minDesktopWidth &&
            self.$sidebar.hasClass("sidebar-fixed")
        ) {
            // is closed ?
            var isClosed = self.$sidebar.hasClass("closed");

            // if navigation style's sidebar
            if (self.isNavigation) {
                isClosed || self.$sidebar.find(".filter-clean").hide();

                self.$sidebar
                    .siblings(".toolbox")
                    .children(":not(:first-child)")
                    .fadeToggle("fast");

                self.$sidebar
                    .find(".sidebar-content")
                    .stop()
                    .animate(
                        {
                            height: "toggle",
                            "margin-bottom": isClosed ? "toggle" : -6,
                        },
                        function () {
                            $(this).css("margin-bottom", "");
                            isClosed &&
                                self.$sidebar
                                    .find(".filter-clean")
                                    .fadeIn("fast");
                        }
                    );
            }

            // if shop sidebar
            if (self.$sidebar.hasClass("shop-sidebar")) {
                // change columns
                var $wrapper = $(".main-content .product-wrapper");
                if ($wrapper.length) {
                    if ($wrapper.hasClass("product-lists")) {
                        // if list type, toggle 2 cols or 1 col
                        $wrapper.toggleClass("row cols-xl-2", !isClosed);
                    } else {
                        // if grid type
                        var colData = $wrapper.data("toggle-cols"),
                            colsClasses = $wrapper
                                .attr("class")
                                .match(/cols-\w*-*\d/g),
                            // get max cols count
                            maxColsCount = colsClasses
                                ? Math.max.apply(
                                      null,
                                      colsClasses.map(function (cls) {
                                          return cls.match(/\d/)[0];
                                      })
                                  )
                                : 0;

                        if (isClosed) {
                            // when open
                            4 === maxColsCount &&
                                3 == colData &&
                                $wrapper.removeClass("cols-md-4");
                        } else {
                            // when close
                            if (3 === maxColsCount) {
                                $wrapper.addClass("cols-md-4");

                                if (!colData) {
                                    $wrapper.data("toggle-cols", 3);
                                }
                            }
                        }
                    }
                }
            }

            // finally, toggle fixed sidebar
            self.$sidebar.toggleClass("closed");
        } else {
            self.$sidebar
                .find(".sidebar-overlay .sidebar-close")
                .css(
                    "margin-left",
                    -(window.innerWidth - document.body.clientWidth)
                );

            // activate sidebar
            Riode.$body
                .toggleClass(self.name + "-active")
                .removeClass("closed");

            // issue
            if (
                window.innerWidth >= 1200 &&
                Riode.$body.hasClass("with-flex-container")
            ) {
                $(".owl-carousel").trigger("refresh.owl.carousel");
            }
        }
    };

    return function (name) {
        return new Sidebar(name);
    };
})();

/**
 * @function initProductSingle
 *
 * @param {jQuery} $el
 * @param {object} options
 *
 * @requires OwlCarousel
 * @requires ImagesLoaded (only quickview needs)
 * @requires elevateZoom
 * @instance multiple
 */

Riode.initProductSingle = moduleProductSingle;

/**
 * @function initProductSinglePage
 *
 * @requires Slider
 * @requires ProductSingle
 * @requires PhotoSwipe
 * @instance single
 */
Riode.initProductSinglePage = moduleProductSinglePage;

Riode.openFullImage = function (e) {
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
};

/**
 * @function slider
 *
 * @requires OwlCarousel
 */
Riode.slider = (function () {
    /**
     * @class Slider
     */
    function Slider($el, options) {
        return this.init($el, options);
    }

    var onInitialize = function (e) {
        var i,
            j,
            breaks = ["", "-xs", "-sm", "-md", "-lg", "-xl"];
        this.classList.remove("row");
        for (i = 0; i < 6; ++i) {
            for (j = 1; j <= 12; ++j) {
                this.classList.remove("cols" + breaks[i] + "-" + j);
            }
        }
        this.classList.remove("gutter-no");
        this.classList.remove("gutter-sm");
        this.classList.remove("gutter-lg");
        if (this.classList.contains("animation-slider")) {
            var els = this.children,
                len = els.length;
            for (var i = 0; i < len; ++i) {
                els[i].setAttribute("data-index", i + 1);
            }
        }
    };
    var onInitialized = function (e) {
        var els = this.firstElementChild.firstElementChild.children,
            i,
            len = els.length;
        for (i = 0; i < len; ++i) {
            if (!els[i].classList.contains("active")) {
                var animates = Riode.byClass("appear-animate", els[i]),
                    j;
                for (j = animates.length - 1; j >= 0; --j) {
                    animates[j].classList.remove("appear-animate");
                }
            }
        }

        // Video
        var $el = $(e.currentTarget);
        $el.find("video").on("ended", function () {
            var $this = $(this);
            if ($this.closest(".owl-item").hasClass("active")) {
                if (true === $el.data("owl.carousel").options.autoplay) {
                    if (
                        false === $el.data("owl.carousel").options.loop &&
                        $el.data().children - 1 ===
                            $el.find(".owl-item.active").index()
                    ) {
                        this.loop = true;
                        this.play();
                    }
                    $el.trigger("next.owl.carousel");
                    $el.trigger("play.owl.autoplay");
                } else {
                    this.loop = true;
                    this.play();
                }
            }
        });
    };
    var onTranslated = function (e) {
        $(window).trigger("appear.check");

        // Video Play
        var $el = $(e.currentTarget),
            $activeVideos = $el.find(".owl-item.active video");

        $el.find(".owl-item:not(.active) video").each(function () {
            if (!this.paused) {
                $el.trigger("play.owl.autoplay");
            }
            this.pause();
            this.currentTime = 0;
        });

        if ($activeVideos.length) {
            if (true === $el.data("owl.carousel").options.autoplay) {
                $el.trigger("stop.owl.autoplay");
            }
            $activeVideos.each(function () {
                this.paused && this.play();
            });
        }
    };
    var onSliderInitialized = function (e) {
        var self = this,
            $el = $(e.currentTarget);

        // carousel content animation

        $el.find(".owl-item.active .slide-animate").each(function () {
            var $animation_item = $(this),
                settings = $.extend(
                    true,
                    {},
                    Riode.defaults.animation,
                    Riode.parseOptions(
                        $animation_item.data("animation-options")
                    )
                ),
                duration = settings.duration,
                delay = settings.delay,
                aniName = settings.name;

            $animation_item.css("animation-duration", duration);

            var temp = Riode.requestTimeout(
                function () {
                    $animation_item.addClass(aniName);
                    $animation_item.addClass("show-content");
                },
                delay ? Number(delay.slice(0, -1)) * 1000 : 0
            );

            self.timers.push(temp);
        });
    };

    var onSliderResized = function (e) {
        $(e.currentTarget)
            .find(".owl-item.active .slide-animate")
            .each(function () {
                var $animation_item = $(this);
                $animation_item.addClass("show-content");
                $animation_item.attr("style", "");
            });
    };

    var onSliderTranslate = function (e) {
        var self = this,
            $el = $(e.currentTarget);
        self.translateFlag = 1;
        self.prev = self.next;
        $el.find(".owl-item .slide-animate").each(function () {
            var $animation_item = $(this),
                settings = $.extend(
                    true,
                    {},
                    Riode.defaults.animation,
                    Riode.parseOptions(
                        $animation_item.data("animation-options")
                    )
                );
            $animation_item.removeClass(settings.name);
        });
    };

    var onSliderTranslated = function (e) {
        var self = this,
            $el = $(e.currentTarget);
        if (1 == self.translateFlag) {
            self.next = $el
                .find(".owl-item")
                .eq(e.item.index)
                .children()
                .attr("data-index");
            $el.find(".show-content").removeClass("show-content");
            if (self.prev != self.next) {
                $el.find(".show-content").removeClass("show-content");
                /* clear all animations that are running. */
                if ($el.hasClass("animation-slider")) {
                    for (var i = 0; i < self.timers.length; i++) {
                        Riode.deleteTimeout(self.timers[i]);
                    }
                    self.timers = [];
                }
                $el.find(".owl-item.active .slide-animate").each(function () {
                    var $animation_item = $(this),
                        settings = $.extend(
                            true,
                            {},
                            Riode.defaults.animation,
                            Riode.parseOptions(
                                $animation_item.data("animation-options")
                            )
                        ),
                        duration = settings.duration,
                        delay = settings.delay,
                        aniName = settings.name;

                    $animation_item.css("animation-duration", duration);
                    $animation_item.css("animation-delay", delay);
                    $animation_item.css(
                        "transition-property",
                        "visibility, opacity"
                    );
                    $animation_item.css("transition-delay", delay);
                    $animation_item.css("transition-duration", duration);
                    $animation_item.addClass(aniName);

                    duration = duration ? duration : "0.75s";
                    $animation_item.addClass("show-content");
                    var temp = Riode.requestTimeout(
                        function () {
                            $animation_item.css("transition-property", "");
                            $animation_item.css("transition-delay", "");
                            $animation_item.css("transition-duration", "");
                            self.timers.splice(self.timers.indexOf(temp), 1);
                        },
                        delay
                            ? Number(delay.slice(0, -1)) * 1000 +
                                  Number(duration.slice(0, -1)) * 500
                            : Number(duration.slice(0, -1)) * 500
                    );
                    self.timers.push(temp);
                });
            } else {
                $el.find(".owl-item")
                    .eq(e.item.index)
                    .find(".slide-animate")
                    .addClass("show-content");
            }
            self.translateFlag = 0;
        }
    };

    // Public Properties

    Slider.zoomImage = function () {
        Riode.zoomImage(this.$element);
    };

    Slider.zoomImageRefresh = function () {
        this.$element.find("img").each(function () {
            var $this = $(this);

            if ($.fn.elevateZoom) {
                var elevateZoom = $this.data("elevateZoom");
                if (typeof elevateZoom !== "undefined") {
                    elevateZoom.refresh();
                } else {
                    Riode.defaults.zoomImage.zoomContainer = $this.parent();
                    $this.elevateZoom(Riode.defaults.zoomImage);
                }
            }
        });
    };

    Riode.defaults.sliderPresets["product-single-carousel"].onInitialized =
        Riode.defaults.sliderPresets["product-gallery-carousel"].onInitialized =
            Slider.zoomImage;
    Riode.defaults.sliderPresets["product-single-carousel"].onRefreshed =
        Riode.defaults.sliderPresets["product-gallery-carousel"].onRefreshed =
            Slider.zoomImageRefresh;

    Slider.prototype.init = function ($el, options) {
        this.timers = [];
        this.translateFlag = 0;
        this.prev = 1;
        this.next = 1;

        Riode.lazyload($el, true);

        var classes = $el.attr("class").split(" "),
            settings = $.extend(true, {}, Riode.defaults.slider);

        // extend preset options
        classes.forEach(function (className) {
            var preset = Riode.defaults.sliderPresets[className];
            preset && $.extend(true, settings, preset);
        });

        var $videos = $el.find("video");
        $videos.each(function () {
            this.loop = false;
        });

        // extend user options
        $.extend(
            true,
            settings,
            Riode.parseOptions($el.attr("data-owl-options")),
            options
        );

        onSliderInitialized = onSliderInitialized.bind(this);
        onSliderTranslate = onSliderTranslate.bind(this);
        onSliderTranslated = onSliderTranslated.bind(this);

        // init
        $el.on("initialize.owl.carousel", onInitialize)
            .on("initialized.owl.carousel", onInitialized)
            .on("translated.owl.carousel", onTranslated);

        // if animation slider
        $el.hasClass("animation-slider") &&
            $el
                .on("initialized.owl.carousel", onSliderInitialized)
                .on("resized.owl.carousel", onSliderResized)
                .on("translate.owl.carousel", onSliderTranslate)
                .on("translated.owl.carousel", onSliderTranslated);

        $el.owlCarousel(settings);
    };

    return function (selector, options) {
        Riode.$(selector).each(function () {
            var $this = $(this);

            Riode.call(function () {
                new Slider($this, options);
            });
        });
    };
})();

/**
 * @class Menu
 */
Riode.Menu = moduleMenu;

/**
 * @function floatSVG
 * @param {string|jQuery} selector
 * @param {object} options
 */
Riode.floatSVG = moduleFloatSVG;

/**
 * @class Shop
 *
 * @requires noUiSlider
 * @instance single
 */
Riode.Shop = moduleShop;

/**
 * Riode Initializer
 */

// Initialize Method while document is being loaded.
Riode.prepare = function () {
    if (
        Riode.$body.hasClass("with-flex-container") &&
        window.innerWidth >= 1200
    ) {
        Riode.$body.addClass("sidebar-active");
    }
};

// Initialize Method while document is interactive
Riode.initLayout = function () {
    Riode.isotopes(".grid:not(.grid-float)");
    Riode.stickySidebar(".sticky-sidebar");
};

// Initialize Method after document has been loaded
Riode.init = function () {
    Riode.appearAnimate(".appear-animate"); // Runs appear animations
    Riode.playableVideo(".post-video"); // Initialize playable video
    Riode.headerToggleSearch(".hs-toggle"); // Initialize header toggle search
    Riode.parallax(".parallax"); // Initialize parallax
    Riode.initScrollTopButton(); // Initialize scroll top button.
    Riode.closeTopNotice(".btn-notice-close"); // Initialize header toggle search
    Riode.stickyContent(".product-sticky-content, .sticky-header", {
        top: false,
    }); // Initialize sticky content
    Riode.stickyContent(".sticky-footer", Riode.defaults.stickyFooter); // Initialize sticky footer
    Riode.stickyContent(".sticky-toolbox", Riode.defaults.stickyToolbox); // Initialize sticky toolbox
    Riode.initAccordion(".card-header > a"); // Initialize accordion
    Riode.initTab(".nav-tabs"); // Initialize tab
    Riode.initAlert(".alert"); // Initialize alert
    Riode.initPopups(); // Initialize popups: play video, newsletter popup
    Riode.initZoom(); // Initialize zoom
    Riode.floatSVG(".float-svg"); // Floating SVG
    Riode.Menu.init(); // Initialize menus
    // Riode.countTo(".count-to"); // Initialize countTo (use in about page)

    // Riode.countdown(".product-countdown, .countdown"); // Initialize countdown

    // chua chuyen code
    // Riode.slider(".owl-carousel"); // Initialize slider
    Riode.sidebar("sidebar"); // Initialize left sidebar
    Riode.sidebar("right-sidebar"); // Initialize right sidebar
    Riode.sidebar("top-sidebar"); // Initialize right sidebar

    Riode.Shop.init(); // Initialize shop
    // Riode.initProductSinglePage(); // Initialize single product page
    Riode.initNavFilter(".nav-filters .nav-filter"); // Initialize navigation filters for blog, products
    Riode.initShowVendorSearch(".toolbox .form-toggle-btn"); // Initialize show vendor search form

    Riode.status = "complete";
};

export default Riode;
