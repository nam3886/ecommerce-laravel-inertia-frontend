<template>
  <div class="product-label-group">
    <span v-if="discount" class="product-label label-sale">
      {{ discount.price_format }} Off
    </span>
    <label v-if="flag" :class="[labelClass]" class="product-label">
      {{ flag }}
    </label>
  </div>
</template>

<script>
export default {
  props: ["flag", "discount"],

  data() {
    return {
      available: {
        new: "label-new",
        top: "label-top",
        stock: "label-stock",
        hot: "label-hot",
      },
    };
  },

  computed: {
    labelClass() {
      const flag = (this.flag || "").toLowerCase();
      return this.available[flag] || this.available.top;
    },
  },
};
</script>

<style>
</style>