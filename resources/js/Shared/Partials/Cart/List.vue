<template>
  <div v-for="(cart, index) in carts" :key="index" :class="{ 'mt-7': index }">
    <h5>
      <i class="fas fa-store text-primary"></i>&nbsp;
      {{ cart.shop.name }}
    </h5>
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
        <tr v-for="item in cart.items" :key="item.rowId">
          <td class="product-thumbnail">
            <figure>
              <link-slug :slug="item.options.slug">
                <img
                  :src="item.options.avatar.url"
                  :alt="item.options.avatar.name"
                  width="100"
                  height="100"
                />
              </link-slug>
            </figure>
          </td>
          <td class="product-name">
            <div class="product-name-section break-word">
              <link-slug :slug="item.options.slug">{{ item.name }}</link-slug>
            </div>
          </td>
          <td class="product-subtotal">
            <span class="amount">{{ item.options.price_format }}</span>
          </td>
          <td class="product-quantity">
            <input-number
              v-model.number="item.qty"
              @update:modelValue="updateQuantity($event, item)"
              :max="item.options.max"
              min="1"
            />
          </td>
          <td class="product-price">
            <span class="amount">{{ item.options.subtotal_format }}</span>
          </td>
          <td class="product-close">
            <a
              @click.prevent="destroy(item.rowId)"
              href="#"
              class="product-remove"
              title="Remove this product"
            >
              <i class="fas fa-times"></i>
            </a>
          </td>
        </tr>
        <tr v-if="cart.tax">
          <td colspan="4" class="product-name">Thuế</td>
          <td colspan="2" class="product-price">{{ cart.tax_format }}</td>
        </tr>
        <tr>
          <td colspan="4" class="product-name">Tổng tiền</td>
          <td colspan="2" class="product-price">{{ cart.total_format }}</td>
        </tr>
      </tbody>
    </table>
  </div>
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

  methods: {
    updateQuantity: debounce(function (newQuatity, item) {
      this.update(item.rowId, newQuatity);
    }, 300),
  },
};
</script>
