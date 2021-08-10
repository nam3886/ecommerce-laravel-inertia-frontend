<template>
  <div>
    <div v-if="product.discount" class="product-price">
      <ins class="new-price">{{ product.price_after_discount_format }}</ins>
      <del class="old-price">{{ product.price_format }}</del>
    </div>
    <div
      v-if="product.discount"
      class="product-countdown-container font-weight-semi-bold"
    >
      <label class>Off Ends In:</label>
      <div
        ref="countdown"
        :data-until="endDay"
        data-compact="true"
        class="product-countdown countdown-compact"
      >
        00:00:00
      </div>
      <!-- End of .product-countdown -->
    </div>
    <div v-else class="product-price">
      {{ product.price_after_discount_format }}
    </div>
  </div>
</template>

<script>
import Riode from "@/Riode/";

export default {
  props: ["product"],

  computed: {
    endDay() {
      if (!this.product) return "";
      const endDay = new Date(this.product.discount.end);
      const date = endDay.getUTCDate();
      const mounth = endDay.getUTCMonth() + 1;
      const year = endDay.getUTCFullYear();
      const hours = endDay.getUTCHours();
      const minutes = endDay.getUTCMinutes();
      const seconds = endDay.getUTCSeconds();
      return `${year}, ${mounth}, ${date}, ${hours}, ${minutes}, ${seconds}`;
    },
  },

  mounted() {
    // Initialize countdown
    Riode.countdown(this.$refs.countdown);
  },
};
</script>

