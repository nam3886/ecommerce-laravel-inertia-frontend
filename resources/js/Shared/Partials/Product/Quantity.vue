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
        :disabled="!selectedAllVariants || isProcessing"
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
        {{ $MESSAGES.REACH_MAX }}
      </span>
    </div>
  </div>
</template>

<script>
import InputNumber from "@/Shared/Inputs/Number.vue";
export default {
  props: ["availableQuantity", "selectedAllVariants"],

  emits: ["add-cart"],

  components: { InputNumber },

  data() {
    return {
      quantity: 1,
      show: false,
      isProcessing: false,
    };
  },

  watch: {
    availableQuantity() {
      this.show = false;
    },
  },

  mounted() {
    this.$EMITTER.on("processing", () => (this.isProcessing = true));

    this.$EMITTER.on("processed", () => (this.isProcessing = false));
  },
};
</script>

