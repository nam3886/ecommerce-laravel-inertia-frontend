const modulePlayableVideo = function(selector) {
    $(selector + " .video-play").on("click", function(e) {
        var $video = $(this).closest(selector);
        if ($video.hasClass("playing")) {
            $video
                .removeClass("playing")
                .addClass("paused")
                .find("video")[0]
                .pause();
        } else {
            $video
                .removeClass("paused")
                .addClass("playing")
                .find("video")[0]
                .play();
        }
        e.preventDefault();
    });
    $(selector + " video").on("ended", function() {
        $(this)
            .closest(selector)
            .removeClass("playing");
    });
};

export default modulePlayableVideo;
