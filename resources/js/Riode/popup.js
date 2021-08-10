import Riode from "@/Riode/";

const modulePopup = function() {
    Riode.$body
        // Register "Play Video" Popup
        .on("click", ".btn-iframe", function(e) {
            e.preventDefault();
            Riode.popup(
                {
                    items: {
                        src:
                            '<video src="' +
                            $(e.currentTarget).attr("href") +
                            '" autoplay loop controls>',
                        type: "inline"
                    },
                    mainClass: "mfp-video-popup"
                },
                "video"
            );
        });

    // Open newsletter Popup after 7.5s in home pages
    if (
        $("#newsletter-popup").length > 0 &&
        Riode.getCookie("hideNewsletterPopup") !== "true"
    ) {
        setTimeout(function() {
            Riode.popup({
                items: {
                    src: "#newsletter-popup"
                },
                type: "inline",
                tLoading: "",
                mainClass: "mfp-newsletter mfp-flip-popup",
                callbacks: {
                    beforeClose: function() {
                        // if "do not show" is checked
                        $("#hide-newsletter-popup")[0].checked &&
                            Riode.setCookie("hideNewsletterPopup", true, 7);
                    }
                }
            });
        }, 7500);
    }
};

export default modulePopup;
