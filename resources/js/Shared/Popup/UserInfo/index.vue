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
          <div class="login-popup overlay-popup">
            <div class="form-box">
              <div class="tab tab-nav-simple tab-nav-boxed form-tab">
                <ul
                  class="
                    nav nav-tabs nav-fill
                    align-items-center
                    border-no
                    justify-content-center
                    mb-5
                  "
                  role="tablist"
                >
                  <li class="nav-item">
                    <span class="nav-link active border-no lh-1 ls-normal">
                      Thông tin
                    </span>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active">
                    <form @submit.prevent="updateUserAddress">
                      <group>
                        <input
                          :value="$page.props.user.name"
                          disabled
                          type="text"
                          class="form-control not-allowed"
                          placeholder="Họ và Tên"
                        />
                      </group>
                      <group>
                        <input
                          :value="$page.props.user.phone"
                          disabled
                          type="text"
                          class="form-control not-allowed"
                          placeholder="Số điện thoại"
                        />
                      </group>
                      <user-info v-model="form" />
                      <div class="d-flex">
                        <button
                          @click="handleCancel"
                          :disabled="form.processing"
                          :class="{ 'opacity-65 not-allowed': form.processing }"
                          type="button"
                          class="
                            btn
                            btn-md
                            btn-dark
                            btn-block
                            btn-rounded
                            btn-outline
                            mr-4
                          "
                          style="border-width: 1px"
                        >
                          Trở lại
                        </button>

                        <button-spinner
                          v-model="form.processing"
                          :class="{ 'not-allowed': form.processing }"
                          :disabled="form.processing"
                          as="button"
                          type="submit"
                          class="btn btn-dark btn-block btn-rounded ml-4"
                        >
                          Thay đổi
                        </button-spinner>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <button
              @click="handleCancel"
              title="Close (Esc)"
              type="button"
              class="mfp-close"
            >
              <span>×</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import InteractsWithPopup from "@/Mixins/InteractsWithPopup.vue";
import ButtonSpinner from "@/Shared/Buttons/Spinner.vue";
import UserInfo from "@/Shared/Popup/UserInfo/UserInfo.vue";
import Group from "@/Shared/Inputs/Group.vue";

export default {
  mixins: [InteractsWithPopup],

  components: { UserInfo, Group, ButtonSpinner },

  data() {
    return {
      show: false,
      form: this.$inertia.form({
        ghn_address: {},
        address: null,
      }),
    };
  },

  watch: {
    show(show) {
      if (!show) {
        this.form.clearErrors();
        this.form.ghn_address = {};
      }
    },
  },

  mounted() {
    this.$EMITTER.on("show-popup:user-info", () => (this.show = true));

    this.$EMITTER.on("hide-popup:user-info", () => (this.show = false));
  },

  methods: {
    updateUserAddress() {
      this.form.put(this.route("user.update_address"), {
        onSuccess: () => this.$EMITTER.emit("hide-popup:user-info"),
        preserveState: false,
        preserveScroll: true,
      });
    },

    handleCancel() {
      this.show = false;
      this.$EMITTER.emit("hide-popup:user-info");
    },
  },
};
</script>
