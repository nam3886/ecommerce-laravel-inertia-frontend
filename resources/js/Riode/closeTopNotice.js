import Riode from "@/Riode/";

const moduleCloseTopNotice = function(selector) {
    var $closeBtn = Riode.$(selector);
    $closeBtn.on("click", function(e) {
        e.preventDefault();
        $closeBtn.closest(".top-notice").css("display", "none");
    });
};

export default moduleCloseTopNotice;
