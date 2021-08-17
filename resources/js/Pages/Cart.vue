<template>
  <main class="main cart">
    <div class="page-content pt-7 pb-10">
      <checkout-breadcrumb index-active="1" />

      <div class="container mt-7 mb-2">
        <flash-message class="mb-2" />
        <div class="row">
          <div class="col-lg-8 col-md-12 pr-lg-4">
            <cart-list :carts="cartGroupByShop.items" />

            <div class="cart-actions mb-6 pt-4">
              <a
                href="shop.html"
                class="btn btn-dark btn-md btn-rounded btn-icon-left mr-4 mb-4"
                ><i class="d-icon-arrow-left"></i>Continue Shopping</a
              >
              <button
                type="submit"
                class="btn btn-outline btn-dark btn-md btn-rounded btn-disabled"
              >
                Update Cart
              </button>
            </div>

            <cart-coupon />
          </div>

          <cart-shipping :cart="cart" :deliveryMethods="deliveryMethods" />
        </div>
      </div>
    </div>

    <Head title="Cart" />
  </main>
</template>

<script>
import Layout from "@/Layouts/AppLayout/index.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import CheckoutBreadcrumb from "@/Shared/CheckoutBreadcrumb.vue";
import FlashMessage from "@/Shared/Alert/FlashMessage.vue";
import CartList from "@/Shared/Partials/Cart/List.vue";
import CartCoupon from "@/Shared/Partials/Cart/Coupon.vue";
import CartShipping from "@/Shared/Partials/Cart/Shipping.vue";
import "@r/css/style.css";

export default {
  layout: Layout,

  components: {
    Head,
    Link,
    CheckoutBreadcrumb,
    FlashMessage,
    CartList,
    CartCoupon,
    CartShipping,
  },

  props: ["cart", "cartGroupByShop", "deliveryMethods"],
};
</script>