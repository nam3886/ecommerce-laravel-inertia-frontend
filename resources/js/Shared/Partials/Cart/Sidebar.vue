<template>
  <aside class="col-lg-4 sticky-sidebar-wrapper">
    <div class="sticky-sidebar" data-sticky-options="{'bottom': 0}">
      <div class="summary mb-4">
        <h3 class="summary-title text-left">Tổng giỏ hàng</h3>
        <table class="shipping">
          <tr class="summary-subtotal">
            <td>
              <h4 class="summary-subtitle">Tổng tiền hàng</h4>
            </td>
            <td>
              <p class="summary-subtotal-price">{{ cart.subtotal_format }}</p>
            </td>
          </tr>
          <tr v-if="cart.shipping_fee" class="summary-subtotal">
            <td>
              <h4 class="summary-subtitle">Phí vận chuyển</h4>
            </td>
            <td>
              <p class="summary-subtotal-price">
                {{ cart.shipping_fee_format }}
              </p>
            </td>
          </tr>
        </table>
        <table class="total">
          <tr class="summary-subtotal">
            <td>
              <h4 class="summary-subtitle">Tổng</h4>
            </td>
            <td>
              <p class="summary-total-price ls-s">
                <!-- {{ cart.grandtotal_format }} -->
                {{ cart.total_format }}
              </p>
            </td>
          </tr>
        </table>
        <Link
          :href="route('checkout.index')"
          class="btn btn-dark btn-rounded btn-checkout"
        >
          Thanh toán
        </Link>
      </div>
    </div>
  </aside>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: { Link },

  props: ["cart"],
};
</script>
