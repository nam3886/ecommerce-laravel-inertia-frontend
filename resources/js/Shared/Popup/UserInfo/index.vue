<template>
  <div v-if="show">
    <div class="mfp-bg mfp-login mfp-fade mfp-ready"></div>
    <div
      @click="overlay"
      class="
        mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-login mfp-fade mfp-ready
      "
      tabindex="-1"
      style="overflow: hidden auto"
    >
      <div class="mfp-container mfp-ajax-holder mfp-s-ready">
        <div class="mfp-content">
          <user-info>
            <button
              @click="show = false"
              title="Close (Esc)"
              type="button"
              class="mfp-close"
            >
              <span>×</span>
            </button>
          </user-info>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import UserInfo from "@/Shared/Popup/UserInfo/UserInfo.vue";
import InteractsWithPopup from "@/Mixins/InteractsWithPopup.vue";

export default {
  mixins: [InteractsWithPopup],

  components: { UserInfo },

  data() {
    return {
      show: false,
    };
  },

  mounted() {
    this.$EMITTER.on("show-popup:user-info", () => (this.show = true));

    this.$EMITTER.on("hide-popup:user-info", () => (this.show = false));
  },
};
</script>
