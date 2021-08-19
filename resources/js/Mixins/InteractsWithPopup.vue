<script>
export default {
  watch: {
    show(show) {
      if (show) {
        const scrollWidth = window.innerWidth - document.body.clientWidth;
        $("html").css("overflow-y", "hidden");
        $("body").css("overflow-x", "visible");
        $(".mfp-wrap").css("overflow", "hidden auto");
        $(".sticky-header.fixed").css("padding-right", scrollWidth);
        $("html").css("margin-right", scrollWidth);
        $("#scroll-top").css("margin-right", scrollWidth);
      } else {
        $("html").css("overflow-y", "");
        $("body").css("overflow-x", "hidden");
        $(".mfp-wrap").css("overflow", "");
        $(".sticky-header.fixed").css("padding-right", "");
        $("html").css("margin-right", "");
        $("#scroll-top").css("margin-right", "");
      }
    },
  },

  methods: {
    overlay(event) {
      if (!$(event.target).closest(".overlay-popup").length) {
        this.show = false;
      }
    },
  },
};
</script>