<template>
  <div class="product-details scrollable pr-0 pr-md-3">
    <h1 class="product-name mt-0">{{ product.name }}</h1>
    <div class="product-meta">
      SKU: <span class="product-sku">{{ product.sku }}</span> BRAND:
      <span class="product-brand">{{ product.brand.name }}</span>
    </div>

    <price :product="product" />

    <div class="ratings-container">
      <div class="ratings-full">
        <span class="ratings" style="width: 80%"></span>
        <span class="tooltiptext tooltip-top"></span>
      </div>
      <a href="#product-tab-reviews" class="link-to-tab rating-reviews"
        >( 11 reviews )</a
      >
    </div>
    <p class="product-short-desc">
      {{ product.sub_description }}
    </p>

    <variants
      v-if="product.has_variants"
      :attributes="attributes"
      :price="_price"
      @update:variant="$emit('update:variant', $event)"
      @clear:variant="$emit('clear:variant', $event)"
    />

    <hr class="product-divider" />

    <quantity
      :availableQuantity="availableQuantity"
      @add-cart="$emit('add-cart', $event)"
    />

    <hr class="product-divider mb-3" />

    <action />
  </div>
</template>

<script>
import Riode from "@/Riode/";
import Price from "@/Shared/Partials/Product/Price.vue";
import Variants from "@/Shared/Partials/Product/Variants.vue";
import Quantity from "@/Shared/Partials/Product/Quantity.vue";
import Action from "@/Shared/Partials/Product/Action.vue";

export default {
  props: ["product", "attributes", "_price", "availableQuantity"],

  emits: ["add-cart", "clear:variant", "update:variant"],

  components: { Price, Variants, Quantity, Action },

  mounted() {
    // Initialize ProductSinglePage
    Riode.initProductSinglePage(".product-single.is-quickview");
  },
};
</script>
