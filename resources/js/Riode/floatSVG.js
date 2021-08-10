import Riode from "@/Riode/";

const moduleFloatSVG = (function() {
    function FloatSVG(svg, options) {
        this.$el = $(svg);
        this.set(options);
        this.start();
    }

    FloatSVG.prototype.set = function(options) {
        this.options = $.extend(
            {
                delta: 15,
                speed: 10,
                size: 1
            },
            typeof options == "string" ? Riode.parseOptions(options) : options
        );
    };

    FloatSVG.prototype.getDeltaY = function(dx) {
        return (
            Math.sin(((2 * Math.PI * dx) / this.width) * this.options.size) *
            this.options.delta
        );
    };

    FloatSVG.prototype.start = function() {
        this.update = this.update.bind(this);
        this.timeStart = Date.now() - parseInt(Math.random() * 100);
        this.$el.find("path").each(function() {
            $(this).data(
                "original",
                this.getAttribute("d").replace(/([\d])\s*\-/g, "$1,-")
            );
        });

        window.addEventListener("resize", this.update, { passive: true });
        window.addEventListener("scroll", this.update, { passive: true });
        Riode.$window.on("check_float_svg", this.update);
        this.update();
    };

    FloatSVG.prototype.update = function() {
        var self = this;

        if (this.$el.length && Riode.isOnScreen(this.$el[0])) {
            // && $.contains(this.$el, document.body)) {
            Riode.requestTimeout(function() {
                self.draw();
            }, 16);
        }
    };

    FloatSVG.prototype.draw = function() {
        var self = this,
            _dx = ((Date.now() - this.timeStart) * this.options.speed) / 200;
        this.width = this.$el.width();
        if (!this.width) {
            return;
        }
        this.$el.find("path").each(function() {
            var dx = _dx,
                dy = 0;
            this.setAttribute(
                "d",
                $(this)
                    .data("original")
                    .replace(/M([\d|\.]*),([\d|\.]*)/, function(match, p1, p2) {
                        if (p1 && p2) {
                            return (
                                "M" +
                                p1 +
                                "," +
                                (
                                    parseFloat(p2) +
                                    (dy = self.getDeltaY(
                                        (dx += parseFloat(p1))
                                    ))
                                ).toFixed(3)
                            );
                        }
                        return match;
                    })
                    .replace(/([c|C])[^A-Za-z]*/g, function(match, p1) {
                        if (p1) {
                            var v = match
                                .slice(1)
                                .split(",")
                                .map(parseFloat);
                            if (v.length == 6) {
                                if ("C" == p1) {
                                    v[1] += self.getDeltaY(_dx + v[0]);
                                    v[3] += self.getDeltaY(_dx + v[2]);
                                    v[5] += self.getDeltaY((dx = _dx + v[4]));
                                } else {
                                    v[1] += self.getDeltaY(dx + v[0]) - dy;
                                    v[3] += self.getDeltaY(dx + v[2]) - dy;
                                    v[5] += self.getDeltaY((dx += v[4])) - dy;
                                }
                                dy = self.getDeltaY(dx);

                                return (
                                    p1 +
                                    v
                                        .map(function(v) {
                                            return v.toFixed(3);
                                        })
                                        .join(",")
                                );
                            }
                        }
                        return match;
                    })
            );
        });

        this.update();
    };

    return function(selector) {
        Riode.$(selector).each(function() {
            var $this = $(this),
                float;
            if (this.tagName == "svg") {
                float = $this.data("float-svg");
                if (float) {
                    float.set($this.attr("data-float-options"));
                } else {
                    $this.data(
                        "float-svg",
                        new FloatSVG(this, $this.attr("data-float-options"))
                    );
                }
            }
        });
    };
})();

export default moduleFloatSVG;
