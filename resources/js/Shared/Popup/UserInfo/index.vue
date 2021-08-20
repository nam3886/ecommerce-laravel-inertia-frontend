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
          <user-info @submit="updateUserAddress">
            <template #action="{ form }">
              <div class="d-flex">
                <button
                  :disabled="form.processing"
                  :class="{ 'opacity-65 not-allowed': form.processing }"
                  type="button"
                  class="
                    btn btn-md btn-dark btn-block btn-rounded btn-outline
                    mr-4
                  "
                  style="border-width: 1px"
                >
                  Trở lại
                </button>
                <button
                  :disabled="form.processing"
                  :class="{ 'opacity-65 not-allowed': form.processing }"
                  class="btn btn-dark btn-block btn-rounded ml-4"
                  type="submit"
                >
                  Thay đổi
                </button>
              </div>
            </template>

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

export default {
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

  methods: {
    updateUserAddress(form, address) {
      form.address = address;

      form.put(this.route("user.update_address"), {
        onSuccess: () => this.$EMITTER.emit("hide-popup:user-info"),
        preserveState: false,
        preserveScroll: true,
      });
    },
  },
};
</script>
