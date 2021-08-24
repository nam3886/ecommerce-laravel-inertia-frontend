import Riode from "@/Riode/";

const moduleHeaderToggleSearch = function(selector) {
    var $search = Riode.$(selector);
    $search
        .find(".form-control")
        .on("focusin", function(e) {
            $search.addClass("show");
        })
        .on("focusout", function(e) {
            $search.removeClass("show");
        });

    // Initialize sticky footer's search toggle.
    Riode.$body.on("click", ".sticky-footer .search-toggle", function(e) {
        $(this)
            .parent()
            .toggleClass("show");
        e.preventDefault();
    });
};

export default moduleHeaderToggleSearch;
