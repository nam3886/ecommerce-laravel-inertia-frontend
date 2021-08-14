<template>
  <div>
    <p class="minipopup-title">Successfully Added</p>
    <div class="product product-purchased product-cart mb-0">
      <figure class="product-media">
        <link-slug :slug="cart.options.slug">
          <img
            :src="cart.options.avatar.url"
            :alt="cart.options.avatar.name"
            width="90"
            height="90"
          />
        </link-slug>
      </figure>
      <div class="product-detail">
        <link-slug :slug="cart.options.slug" class="product-name">
          {{ cart.name }}
        </link-slug>
        <div class="price-box">
          <span class="product-quantity">{{ quantity }}</span>
          <span class="product-price">
            {{ cart.options.price_format }}
          </span>
        </div>
      </div>
    </div>
    <div class="action-group d-flex">
      <Link
        :href="route('cart.index')"
        class="btn btn-sm btn-outline btn-primary btn-rounded"
      >
        View Cart
      </Link>
      <Link
        :href="route('checkout.index')"
        class="btn btn-sm btn-primary btn-rounded"
      >
        Check Out
      </Link>
    </div>
  </div>
</template>

<script>
import LinkSlug from "@/Shared/ProductElement/LinkSlug.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
  components: { LinkSlug, Link },

  props: ["cart", "quantity"],
};
</script>