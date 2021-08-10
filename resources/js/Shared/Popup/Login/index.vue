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
          <login-popup>
            <button
              @click="show = false"
              title="Close (Esc)"
              type="button"
              class="mfp-close"
            >
              <span>×</span>
            </button>
          </login-popup>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { wait } from "@/helpers.js";
import LoginPopup from "@/Shared/Popup/Login/Login.vue";
import InteractsWithPopup from "@/Mixins/InteractsWithPopup.vue";

export default {
  mixins: [InteractsWithPopup],

  components: { LoginPopup },

  data() {
    return {
      show: false,
    };
  },

  mounted() {
    this.emitter.on("show-popup:login", (selector) => {
      this.show = true;
      wait().then(() => $(`.login-popup a[href="#${selector}"]`).click());
    });

    this.emitter.on("hide-popup:login", () => (this.show = false));
  },

  methods: {
    overlay(event) {
      if (!$(event.target).closest(".overlay-popup").length) {
        this.show = this.isQuickview = this.isLogin = false;
      }
    },
  },
};
</script>
