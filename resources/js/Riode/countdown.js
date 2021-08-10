import Riode from "@/Riode/";

const moduleCountdown = function(selector) {
    if ($.fn.countdown) {
        Riode.$(selector).each(function() {
            var $this = $(this),
                untilDate = $this.data("until"),
                compact = $this.data("compact"),
                dateFormat = !$this.data("format")
                    ? "DHMS"
                    : $this.data("format"),
                newLabels = !$this.data("labels-short")
                    ? [
                          "Years",
                          "Months",
                          "Weeks",
                          "Days",
                          "Hours",
                          "Minutes",
                          "Seconds"
                      ]
                    : [
                          "Years",
                          "Months",
                          "Weeks",
                          "Days",
                          "Hours",
                          "Mins",
                          "Secs"
                      ],
                newLabels1 = !$this.data("labels-short")
                    ? [
                          "Year",
                          "Month",
                          "Week",
                          "Day",
                          "Hour",
                          "Minute",
                          "Second"
                      ]
                    : ["Year", "Month", "Week", "Day", "Hour", "Min", "Sec"];

            var newDate;

            // Split and created again for ie and edge
            if (!$this.data("relative")) {
                var untilDateArr = untilDate.split(", "),
                    // data-until 2019, 10, 8, 10, 05, 59 - yy, mm, dd, H, m, s
                    newDate = new Date(
                        untilDateArr[0],
                        untilDateArr[1] - 1,
                        untilDateArr[2],
                        untilDateArr[3],
                        untilDateArr[4],
                        untilDateArr[5]
                    );
            } else {
                newDate = untilDate;
            }

            $this.countdown({
                until: newDate,
                format: dateFormat,
                padZeroes: true,
                compact: compact,
                compactLabels: [" y", " m", " w", " days, "],
                timeSeparator: " : ",
                labels: newLabels,
                labels1: newLabels1
            });
        });
        // Pause
        // $('.countdown').countdown('pause');
    }
};

export default moduleCountdown;
