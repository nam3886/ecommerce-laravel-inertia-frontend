import Riode from "@/Riode/";

const moduleMenu = {
    init: function() {
        this.initMenu();
        this.initMobileMenu();
        this.initFilterMenu();
        this.initCategoryMenu();
        this.initCollapsibleWidget();
    },
    initMenu: function() {
        // setup menu
        $(".menu li").each(function() {
            if (
                this.lastElementChild &&
                (this.lastElementChild.tagName === "UL" ||
                    this.lastElementChild.classList.contains("megamenu"))
            ) {
                this.classList.add("submenu");
            }
        });

        $(".main-nav .megamenu, .main-nav .submenu > ul").each(function() {
            var $this = $(this),
                left = $this.offset().left,
                outerWidth = $this.outerWidth(),
                offset = left + outerWidth - (window.innerWidth - 20);
            if (offset >= 0 && left > 20) {
                $this.css("margin-left", "-=" + offset);
            }
        });

        // calc megamenu position
        Riode.$window.on("resize", function() {
            $(".main-nav .megamenu, .main-nav .submenu > ul").each(function() {
                var $this = $(this),
                    left = $this.offset().left,
                    outerWidth = $this.outerWidth(),
                    offset = left + outerWidth - (window.innerWidth - 20);
                if (offset >= 0 && left > 20) {
                    $this.css("margin-left", "-=" + offset);
                }
            });
        });
    },
    initMobileMenu: function() {
        function showMobileMenu() {
            Riode.$body.addClass("mmenu-active");
        }
        function hideMobileMenu() {
            Riode.$body.removeClass("mmenu-active");
        }

        $(".mobile-menu li, .toggle-menu li").each(function() {
            if (
                this.lastElementChild &&
                (this.lastElementChild.tagName === "UL" ||
                    this.lastElementChild.classList.contains("megamenu"))
            ) {
                var span = document.createElement("span");
                span.className = "toggle-btn";
                this.firstElementChild.appendChild(span);
            }
        });
        $(".mobile-menu-toggle").on("click", showMobileMenu);
        $(".mobile-menu-overlay").on("click", hideMobileMenu);
        $(".mobile-menu-close").on("click", hideMobileMenu);
        Riode.$window.on("resize", hideMobileMenu);
    },
    initFilterMenu: function() {
        $(".search-ul li").each(function() {
            if (
                this.lastElementChild &&
                this.lastElementChild.tagName === "UL"
            ) {
                var i = document.createElement("i");
                i.className = "fas fa-chevron-down";
                this.classList.add("with-ul");
                this.firstElementChild.appendChild(i);
            }
        });
        $(".with-ul > a i, .toggle-btn").on("click", function(e) {
            $(this)
                .parent()
                .next()
                .slideToggle(300)
                .parent()
                .toggleClass("show");
            setTimeout(function() {
                $(".sticky-sidebar").trigger("recalc.pin");
            }, 320);
            e.preventDefault();
        });
    },
    initCategoryMenu: function() {
        // cat dropdown
        var $menu = $(".category-dropdown");
        if ($menu.length) {
            var $box = $menu.find(".dropdown-box");
            if ($box.length) {
                var top = $(".main").offset().top + $box[0].offsetHeight;
                if (
                    window.pageYOffset > top ||
                    window.innerWidth < Riode.minDesktopWidth
                ) {
                    $menu.removeClass("show");
                }
                window.addEventListener(
                    "scroll",
                    function() {
                        if (
                            window.pageYOffset <= top &&
                            window.innerWidth >= Riode.minDesktopWidth
                        ) {
                            $menu.removeClass("show");
                        }
                    },
                    { passive: true }
                );
                $(".category-toggle").on("click", function(e) {
                    e.preventDefault();
                });
                $menu.on("mouseover", function(e) {
                    if (
                        window.pageYOffset > top &&
                        window.innerWidth >= Riode.minDesktopWidth
                    ) {
                        $menu.addClass("show");
                    }
                });
                $menu.on("mouseleave", function(e) {
                    if (
                        window.pageYOffset > top &&
                        window.innerWidth >= Riode.minDesktopWidth
                    ) {
                        $menu.removeClass("show");
                    }
                });
            }
            if ($menu.hasClass("with-sidebar")) {
                var sidebar = Riode.byClass("sidebar");
                if (sidebar.length) {
                    $menu
                        .find(".dropdown-box")
                        .css("width", sidebar[0].offsetWidth - 20);

                    // set category menu's width same as sidebar.
                    Riode.$window.on("resize", function() {
                        $menu
                            .find(".dropdown-box")
                            .css("width", sidebar[0].offsetWidth - 20);
                    });
                }
            }
        }
    },
    initCollapsibleWidget: function() {
        // generate toggle icon
        $(".widget-collapsible .widget-title").each(function() {
            var span = document.createElement("span");
            span.className = "toggle-btn";
            this.appendChild(span);
        });
        // slideToggle
        $(".widget-collapsible .widget-title").on("click", function(e) {
            var $this = $(this);
            if (!$this.hasClass("sliding")) {
                var $body = $this.siblings(".widget-body");

                $this.hasClass("collapsed") || $body.css("display", "block");

                $this.addClass("sliding");
                $body.slideToggle(300, function() {
                    $this.removeClass("sliding");
                });

                $this.toggleClass("collapsed");
                setTimeout(function() {
                    $(".sticky-sidebar").trigger("recalc.pin");
                }, 320);
            }
        });
    }
};

export default moduleMenu;
