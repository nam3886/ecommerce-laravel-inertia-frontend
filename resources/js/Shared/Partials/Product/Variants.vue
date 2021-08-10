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
            @click="
              $emit('update:variant', { id: attribute.id, code: value.code })
            "
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
          href="#"
          class="product-variation-clean"
          @click.prevent="$emit('clear:variant')"
        >
          Clean All
        </a>
      </div>
    </div>

    <div class="product-variation-price">
      <span>{{ price }}</span>
    </div>
  </div>
</template>

<script>
export default {
  emits: ["clear:variant", "update:variant"],

  props: {
    attributes: {
      type: Array,
      require: true,
    },

    price: {
      type: String,
      require: true,
    },
  },
};
</script>

