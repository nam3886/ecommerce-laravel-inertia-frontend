<template>
  <div>
    <div
      v-for="(attribute, index) in attributes"
      :key="attribute.id"
      :class="['product-form product-' + attribute.code]"
    >
      <label>{{ attribute.name }}:</label>
      <div class="product-form-group">
        <div class="product-variations">
          <a
            v-for="value in attribute.values"
            :key="value.id"
            @click.prevent="selectOption(attribute.id, value)"
            :class="classCalculation(value)"
            href="#"
          >
            {{ value.name }}
          </a>
        </div>
        <!-- <a href="#" class="size-guide">
          <i class="d-icon-th-list"></i>Size Guide
        </a> -->
        <a
          v-if="index === attributes.length - 1"
          @click.prevent="$emit('clear:variant')"
          href="#"
          :class="{ 'd-none': !selectedAllVariants }"
          class="product-variation-clean"
        >
          Clean All
        </a>
      </div>
    </div>

    <div
      :class="{ 'd-block': selectedAllVariants }"
      class="product-variation-price"
    >
      <span>{{ price }}</span>
    </div>
  </div>
</template>

<script>
export default {
  emits: ["clear:variant", "update:variant"],

  props: ["attributes", "selected", "price", "selectedAllVariants"],

  methods: {
    classCalculation(value) {
      return {
        disabled: !value.isValid,
        active: Object.values(this.selected).includes(value.code),
      };
    },

    selectOption(attributeId, value) {
      value.isValid &&
        this.$emit("update:variant", { id: attributeId, code: value.code });
    },
  },
};
</script>

<style scoped>
.product-variations > a:not(.size-guide).disabled {
  cursor: not-allowed;
  color: #d1d5db;
}
.product-variations > a:not(.size-guide).disabled:hover {
  border: 1px solid #e1e1e1;
  box-shadow: unset;
}
</style>