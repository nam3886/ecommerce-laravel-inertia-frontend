<template>
  <div
    v-if="cartItem"
    class="alert alert-simple alert-btn cart-added-alert show"
  >
    <Link :href="route('carts.index')" class="btn btn-success btn-md">
      View Cart
    </Link>
    <span>
      "{{
        cartItem.name +
        (cartItem.options.variant_name
          ? ` (${cartItem.options.variant_name})`
          : "")
      }}" has been added to your cart.
    </span>
    <button type="button" class="btn btn-link btn-close">
      <i class="d-icon-times"></i>
    </button>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import InteractsWithCart from "@/Mixins/InteractsWithCart.vue";

export default {
  mixins: [InteractsWithCart],

  props: ["sku"],

  components: { Link },

  computed: {
    cartItem() {
      return this.getBySku(this.sku);
    },
  },
};
</script>
