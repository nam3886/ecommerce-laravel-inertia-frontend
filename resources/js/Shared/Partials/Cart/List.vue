<template>
  <table class="shop-table cart-table">
    <thead>
      <tr>
        <th><span>Product</span></th>
        <th></th>
        <th><span>Price</span></th>
        <th><span>quantity</span></th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(cart, rowId) in carts" :key="rowId">
        <td class="product-thumbnail">
          <figure>
            <link-slug :slug="cart.options.slug">
              <img
                :src="cart.options.avatar.url"
                :alt="cart.options.avatar.name"
                width="100"
                height="100"
              />
            </link-slug>
          </figure>
        </td>
        <td class="product-name">
          <div class="product-name-section">
            <link-slug :slug="cart.options.slug">{{ cart.name }}</link-slug>
          </div>
        </td>
        <td class="product-subtotal">
          <span class="amount">{{ cart.options.price_format }}</span>
        </td>
        <td class="product-quantity">
          <input-number
            v-model.number="cartQuantities[rowId]"
            @update:modelValue="updateQuantity($event, rowId)"
            :max="cart.options.max"
            min="1"
          />
        </td>
        <td class="product-price">
          <span class="amount">{{ cart.options.subtotal_format }}</span>
        </td>
        <td class="product-close">
          <a
            @click.prevent="destroy(rowId)"
            href="#"
            class="product-remove"
            title="Remove this product"
          >
            <i class="fas fa-times"></i>
          </a>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import debounce from "lodash-es/debounce";
import LinkSlug from "@/Shared/ProductElement/LinkSlug.vue";
import InputNumber from "@/Shared/Inputs/Number.vue";
import InteractsWithCart from "@/Mixins/InteractsWithCart.vue";

export default {
  mixins: [InteractsWithCart],

  props: ["carts"],

  components: { LinkSlug, InputNumber },

  data() {
    return {
      cartQuantities: {},
    };
  },

  mounted() {
    this.getQuantities();
  },

  methods: {
    updateQuantity: debounce(function (newQuatity, rowId) {
      if (newQuatity === this.carts[rowId].qty) return;

      this.update(rowId, newQuatity, () => this.getQuantities());
    }, 500),

    getQuantities() {
      this.cartQuantities = Object.values(this.carts).reduce((carry, cart) => {
        carry[cart.rowId] = cart.qty;
        return carry;
      }, {});
    },
  },
};
</script>
