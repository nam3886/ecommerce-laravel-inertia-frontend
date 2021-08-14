<template>
  <div class="product-price">
    <ins v-if="product.discount" class="new-price">
      {{ product.price_after_discount_format }}
    </ins>
    <del v-if="product.discount" class="old-price">
      {{ product.price_format }}
    </del>
    <span v-else class="price">
      {{ product.price_after_discount_format }}
    </span>
  </div>
</template>

<script>
export default {
  props: ["product"],
};
</script>
