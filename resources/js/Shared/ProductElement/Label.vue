<template>
  <div class="product-label-group">
    <span v-if="discount" class="product-label label-sale">
      giảm {{ discount.price_format }}
    </span>
    <label v-if="flag" :class="[labelClass]" class="product-label">
      {{ transLabel }}
    </label>
    <label v-if="quantity <= 0" class="product-label label-stock"
      >tạm hết</label
    >
  </div>
</template>

<script>
export default {
  props: ["flag", "discount", "quantity"],

  data() {
    return {
      available: {
        new: "label-new",
        top: "label-top",
        hot: "label-hot",
      },
    };
  },

  computed: {
    labelClass() {
      const flag = (this.flag || "").toLowerCase();
      return this.available[flag] || this.available.top;
    },

    transLabel() {
      return (
        {
          new: "mới",
          top: "top",
          hot: "hot",
        }[this.flag] || this.flag
      );
    },
  },
};
</script>
