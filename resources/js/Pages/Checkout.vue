<template>
  <main class="main checkout">
    <div class="page-content pt-7 pb-10 mb-10">
      <checkout-breadcrumb index-active="2" />

      <div class="container mt-7">
        <flash-message class="mb-2" />
        <div class="card accordion">
          <div
            class="alert alert-light alert-primary alert-icon mb-4 card-header"
          >
            <i class="fas fa-exclamation-circle"></i>
            <span class="text-body font-weight-normal"> Have a coupon? </span>
            <a href="#alert-body2" class="text-primary font-weight-normal">
              Click here to enter your code
            </a>
          </div>
          <div class="alert-body mb-4 collapsed" id="alert-body2">
            <p>If you have a coupon code, please apply it below.</p>
            <div class="check-coupon-box d-flex">
              <input
                type="text"
                name="coupon_code"
                class="input-text form-control text-grey ls-m mr-4"
                id="coupon_code"
                value=""
                placeholder="Coupon code"
              />
              <button
                type="submit"
                class="btn btn-dark btn-rounded btn-outline"
              >
                Apply Coupon
              </button>
            </div>
          </div>
        </div>
        <div class="row form">
          <div class="col-lg-7 mb-6 mb-lg-0 pr-lg-4">
            <h3 class="title title-simple text-left text-uppercase">
              Sản phẩm
            </h3>
            <cart-list v-model="notes" :carts="cartGroupByShop.items" />
          </div>
          <invoice
            :notes="notes"
            :user="user"
            :cart="cartGroupByShop"
            :deliveryMethods="deliveryMethods"
            :paymentMethods="paymentMethods"
            :stripePublishableKey="stripePublishableKey"
          />
        </div>
      </div>
    </div>

    <Head title="Checkout" />
  </main>
</template>

<script>
import Layout from "@/Layouts/AppLayout/index.vue";
import { Head } from "@inertiajs/inertia-vue3";
import CheckoutBreadcrumb from "@/Shared/CheckoutBreadcrumb.vue";
import Invoice from "@/Shared/Partials/Checkout/Invoice.vue";
import CartList from "@/Shared/Partials/Checkout/List.vue";
import FlashMessage from "@/Shared/Alert/FlashMessage.vue";
import "@r/css/style.css";

export default {
  layout: Layout,

  components: { Head, CheckoutBreadcrumb, Invoice, CartList, FlashMessage },

  props: [
    "cartGroupByShop",
    "user",
    "deliveryMethods",
    "paymentMethods",
    "stripePublishableKey",
  ],

  data() {
    return {
      notes: {},
    };
  },
};
</script>