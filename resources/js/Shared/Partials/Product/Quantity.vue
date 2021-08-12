<template>
  <div class="product-form product-qty">
    <div class="product-form-group">
      <input-number
        v-model.number="quantity"
        @reach:max="show = true"
        @input="show = false"
        :max="availableQuantity"
        :min="1"
        class="mr-2"
      />
      <button
        @click="$emit('add-cart', quantity)"
        :disabled="!selectedAllVariants"
        type="button"
        class="btn-product btn-cart text-normal ls-normal font-weight-semi-bold"
      >
        <i class="d-icon-bag"></i>Add to Cart
      </button>
      <span
        v-if="show && quantity >= availableQuantity"
        class="text-secondary"
        style="font-size: 13px"
      >
        Đã đạt đến số lượng mua tối đa cho phép của sản phẩm này.
      </span>
    </div>
  </div>
</template>

<script>
import InputNumber from "@/Shared/Inputs/Number.vue";
export default {
  props: ["availableQuantity", "selectedAllVariants"],

  emits: ["add-cart"],

  data() {
    return {
      quantity: 1,
      show: false,
    };
  },

  watch: {
    availableQuantity() {
      this.show = false;
    },
  },

  components: { InputNumber },
};
</script>

