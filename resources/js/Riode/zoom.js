import Riode from "@/Riode/";

const moduleZoom = function() {
    window.addEventListener(
        "resize",
        function() {
            Riode.zoomImageObjects.forEach(function($img) {
                $img.each(function() {
                    var elevateZoom = $(this).data("elevateZoom");
                    elevateZoom && elevateZoom.refresh();
                });
            });
        },
        { passive: true }
    );
};

export default moduleZoom;
