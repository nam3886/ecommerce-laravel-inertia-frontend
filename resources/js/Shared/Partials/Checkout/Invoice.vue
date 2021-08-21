<template>
  <aside class="col-lg-5 sticky-sidebar-wrapper">
    <div class="sticky-sidebar mt-1" data-sticky-options="{'bottom': 50}">
      <div class="summary pt-5">
        <h3 class="title title-simple text-left text-uppercase">Đơn hàng</h3>
        <table class="order-table">
          <thead>
            <tr>
              <th>Địa chỉ nhận hàng</th>
              <th>
                <a
                  @click.prevent="$EMITTER.emit('show-popup:user-info')"
                  href="#"
                >
                  <u>Thay đổi</u>
                </a>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td colspan="2" class="product-name text-left">
                {{ user.name }} {{ user.phone }}
              </td>
            </tr>
            <tr v-if="user.address">
              <td colspan="2" class="product-name text-left">
                {{ user.address?.address }}
              </td>
            </tr>
            <tr class="sumnary-shipping shipping-row-last">
              <td colspan="2">
                <h4 class="summary-subtitle">Vận chuyển</h4>
                <delivery-method
                  v-model="form.delivery_method_id"
                  :methods="deliveryMethods"
                />
                <error-message
                  v-if="form.errors.delivery_method_id"
                  :message="form.errors.delivery_method_id"
                />
              </td>
            </tr>
            <tr class="summary-subtotal">
              <td>
                <h4 class="summary-subtitle">Tổng tiền hàng</h4>
              </td>
              <td class="summary-subtotal-price pb-0 pt-0">
                {{ cart.subtotal_format }}
              </td>
            </tr>
            <tr v-if="cart.tax" class="summary-subtotal">
              <td>
                <h4 class="summary-subtitle">Thuế</h4>
              </td>
              <td class="summary-subtotal-price pb-0 pt-0">
                {{ cart.tax_format }}
              </td>
            </tr>
            <tr v-if="cart.shipping_fee" class="summary-subtotal">
              <td>
                <h4 class="summary-subtitle">Phí vận chuyển</h4>
              </td>
              <td class="summary-subtotal-price pb-0 pt-0">
                {{ cart.shipping_fee_format }}
              </td>
            </tr>
            <tr v-if="cart.discount" class="summary-subtotal">
              <td>
                <h4 class="summary-subtitle">Voucher</h4>
              </td>
              <td class="summary-subtotal-price pb-0 pt-0">
                {{ cart.discount_format }}
              </td>
            </tr>
            <tr class="summary-total">
              <td class="pb-0">
                <h4 class="summary-subtitle">Tổng cộng</h4>
              </td>
              <td class="pt-0 pb-0">
                <p class="summary-total-price ls-s text-primary">
                  {{ cart.grandtotal_format }}
                </p>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="payment accordion radio-type">
          <h4 class="summary-subtitle ls-m pb-3">Thanh toán</h4>
          <payment-method
            v-model="form.payment_method_id"
            :methods="paymentMethods"
          />
          <error-message
            v-if="form.errors.payment_method_id"
            :message="form.errors.payment_method_id"
          />
        </div>
        <div class="form-checkbox mt-4 mb-5">
          <label class="form-control-label pl-0" for="terms-condition">
            Nhấn "Đặt hàng" đồng nghĩa với việc bạn đồng ý tuân theo
            <a href="#">Điều khoản Skinest </a>*
          </label>
        </div>
        <button
          @click="checkout"
          :disabled="form.processing"
          :class="{ 'opacity-65 not-allowed': form.processing }"
          type="button"
          class="btn btn-dark btn-rounded btn-order"
        >
          Đặt hàng
        </button>
      </div>
    </div>
  </aside>
</template>

<script>
import { wait } from "@/helpers.js";
import DeliveryMethod from "@/Shared/Partials/Checkout/DeliveryMethod.vue";
import PaymentMethod from "@/Shared/Partials/Checkout/PaymentMethod.vue";
import ErrorMessage from "@/Shared/Inputs/ErrorMessage.vue";

export default {
  components: { DeliveryMethod, PaymentMethod, ErrorMessage },

  props: ["user", "cart", "deliveryMethods", "paymentMethods"],

  data() {
    return {
      form: this.$inertia.form({
        delivery_method_id: null,
        payment_method_id: null,
      }),
    };
  },

  created() {
    // chưa có shippping fee và user đã có address
    if (!this.cart.shipping_fee && this.user.address) {
      this.form.get(this.route("calculate_shipping_fee"), {
        preserveState: false,
        preserveScroll: true,
      });
    }
  },

  mounted() {
    if (this.user.address) return Object.assign(this.form, this.user.address);
    // wait popup mounted
    wait().then(() => this.$EMITTER.emit("show-popup:user-info"));
  },

  methods: {
    checkout() {
      this.form.post(this.route("checkout.store"));
    },
  },
};
</script>
