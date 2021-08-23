<template>
  <div v-if="show">
    <div class="mfp-bg mfp-login mfp-fade mfp-ready"></div>
    <div
      class="
        mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-login mfp-fade mfp-ready
      "
      tabindex="-1"
      style="overflow: hidden auto"
    >
      <div class="mfp-container mfp-ajax-holder mfp-s-ready">
        <div class="mfp-content">
          <div
            class="login-popup overlay-popup bg-transparent"
            style="box-shadow: unset"
          >
            <div class="form-box">
              <i class="fas fa-spinner loading load-more-overlay"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import InteractsWithPopup from "@/Mixins/InteractsWithPopup.vue";

export default {
  mixins: [InteractsWithPopup],

  data() {
    return {
      show: false,
    };
  },

  mounted() {
    this.$EMITTER.on("processing", () => (this.show = true));

    this.$EMITTER.on("processed", () => (this.show = false));
  },
};
</script>

<style scoped>
.load-more-overlay {
  position: unset;
}
.load-more-overlay::before {
  background-color: transparent;
}
.load-more-overlay::after {
  border-color: #26c !important;
}
</style>
