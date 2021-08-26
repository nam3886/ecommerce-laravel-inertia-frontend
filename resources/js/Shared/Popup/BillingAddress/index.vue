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
                    <form @submit.prevent="updateUserBillingAddress">
                      <group :errorMessage="form.errors.name">
                        <input
                          v-model="form.name"
                          type="text"
                          class="form-control"
                          placeholder="Họ và Tên"
                        />
                      </group>
                      <group :errorMessage="form.errors.phone">
                        <input
                          v-model="form.phone"
                          type="text"
                          class="form-control"
                          placeholder="Số điện thoại"
                        />
                      </group>
                      <user-address
                        v-model="form"
                        @loading="form.processing = true"
                        @loaded="form.processing = false"
                      />
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
import UserAddress from "@/Shared/Popup/BillingAddress/Address.vue";
import Group from "@/Shared/Inputs/Group.vue";

export default {
  mixins: [InteractsWithPopup],

  components: { UserAddress, Group, ButtonSpinner },

  data() {
    return {
      show: false,
      form: this.$inertia.form({
        name: this.$page.props.user.name,
        phone: this.$page.props.user.phone,
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
        this.form.name = this.$page.props.user.name;
        this.form.phone = this.$page.props.user.phone;
      }
    },
  },

  mounted() {
    this.$EMITTER.on("show-popup:user-info", () => (this.show = true));
    this.$EMITTER.on("hide-popup:user-info", () => (this.show = false));
  },

  methods: {
    updateUserBillingAddress() {
      this.form.put(this.route("auth.update_billing_address"), {
        onSuccess: () => this.$EMITTER.emit("hide-popup:user-info"),
        preserveState: false,
        preserveScroll: true,
      });
    },

    handleCancel() {
      this.$EMITTER.emit("hide-popup:user-info");

      this.$page.props.user.address ||
        this.$inertia.visit(this.route("carts.index"));
    },
  },
};
</script>
