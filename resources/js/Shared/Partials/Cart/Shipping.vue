<template>
  <aside class="col-lg-4 sticky-sidebar-wrapper">
    <div class="sticky-sidebar" data-sticky-options="{'bottom': 20}">
      <div class="summary mb-4">
        <h3 class="summary-title text-left">Cart Totals</h3>
        <table class="shipping">
          <tr class="summary-subtotal">
            <td>
              <h4 class="summary-subtitle">Subtotal</h4>
            </td>
            <td>
              <p class="summary-subtotal-price">{{ cart.subtotal_format }}</p>
            </td>
          </tr>
          <tr class="sumnary-shipping shipping-row-last">
            <td colspan="2">
              <h4 class="summary-subtitle">Calculate Shipping</h4>
              <ul>
                <li v-for="delivery in deliveries" :key="delivery.id">
                  <div class="custom-radio">
                    <input
                      type="radio"
                      :id="`delivery${delivery.id}`"
                      name="shipping"
                      class="custom-control-input"
                    />
                    <label
                      :for="`delivery${delivery.id}`"
                      class="custom-control-label"
                      style="text-transform: capitalize"
                    >
                      {{ delivery.name }}
                    </label>
                  </div>
                </li>
              </ul>
            </td>
          </tr>
        </table>
        <div class="shipping-address">
          <label>Shipping to <strong>CA.</strong></label>
          <div class="select-box">
            <select name="country" class="form-control">
              <option value="us" selected>United States (US)</option>
              <option value="uk">United Kingdom</option>
              <option value="fr">France</option>
              <option value="aus">Austria</option>
            </select>
          </div>
          <div class="select-box">
            <select name="country" class="form-control">
              <option value="us" selected>California</option>
              <option value="uk">Alaska</option>
              <option value="fr">Delaware</option>
              <option value="aus">Hawaii</option>
            </select>
          </div>
          <input
            type="text"
            class="form-control"
            name="code"
            placeholder="Town / City"
          />
          <a href="#" class="btn btn-md btn-dark btn-rounded btn-outline"
            >Update totals</a
          >
        </div>
        <table class="total">
          <tr class="summary-subtotal">
            <td>
              <h4 class="summary-subtitle">Total</h4>
            </td>
            <td>
              <p class="summary-total-price ls-s">$426.99</p>
            </td>
          </tr>
        </table>
        <Link
          :href="route('checkout.index')"
          class="btn btn-dark btn-rounded btn-checkout"
        >
          Proceed to checkout
        </Link>
      </div>
    </div>
  </aside>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: { Link },

  props: ["cart", "deliveries"],
};
</script>

<style>
</style>