<template>
  <div class="dropdown cart-dropdown type2 cart-offcanvas mr-0 mr-lg-2">
    <a
      :class="{ 'none-events': route().current('checkout.index') }"
      href="#"
      class="cart-toggle label-block link"
    >
      <div class="cart-label d-lg-show">
        <span class="cart-name">Shopping Cart:</span>
        <span class="cart-price">{{ cart.subtotal_format }}</span>
      </div>
      <i class="d-icon-bag">
        <span class="cart-count">{{ cart.count }}</span>
      </i>
    </a>
    <div ref="overlay" class="cart-overlay"></div>
    <!-- End Cart Toggle -->
    <div v-if="!route().current('checkout.index')" class="dropdown-box">
      <div class="cart-header">
        <h4 class="cart-title">Shopping Cart</h4>
        <a href="#" class="btn btn-dark btn-link btn-icon-right btn-close"
          >close<i class="d-icon-arrow-right"></i
          ><span class="sr-only">Cart</span></a
        >
      </div>
      <div class="products scrollable">
        <!-- Start Cart Product -->
        <div
          v-for="item in cart.items"
          :key="item.rowId"
          class="product product-cart"
        >
          <figure class="product-media">
            <link-slug :slug="item.options.slug">
              <img
                :src="item.options.avatar.url"
                :alt="item.options.avatar.name"
                width="80"
                height="88"
              />
            </link-slug>
            <button @click="destroy(item.rowId)" class="btn btn-link btn-close">
              <i class="fas fa-times"></i><span class="sr-only">Close</span>
            </button>
          </figure>
          <div class="product-detail">
            <link-slug
              :slug="item.options.slug"
              class="product-name break-word two-line-truncate"
            >
              {{ item.name }}
            </link-slug>
            <div class="price-box">
              <span class="product-quantity">{{ item.qty }}</span>
              <span class="product-price">{{ item.options.price_format }}</span>
            </div>
          </div>
        </div>
        <!-- End of Cart Product -->
      </div>
      <!-- End of Products  -->
      <div class="cart-total">
        <label>Subtotal:</label>
        <span class="price">{{ cart.subtotal_format }}</span>
      </div>
      <!-- End of Cart Total -->
      <div class="cart-action">
        <Link :href="route('cart.index')" class="btn btn-dark btn-link">
          View Cart
        </Link>
        <Link :href="route('checkout.index')" class="btn btn-dark">
          <span>Go To Checkout</span>
        </Link>
      </div>
      <!-- End of Cart Action -->
    </div>
    <!-- End Dropdown Box -->
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import InteractsWithCart from "@/Mixins/InteractsWithCart.vue";
import LinkSlug from "@/Shared/ProductElement/LinkSlug.vue";

export default {
  mixins: [InteractsWithCart],

  components: { Link, LinkSlug },

  mounted() {
    this.$EMITTER.on("inertia-finish", () => {
      this.$refs.overlay.click();
    });
  },
};
</script>

