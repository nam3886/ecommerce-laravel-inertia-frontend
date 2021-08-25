<template>
  <component
    :is="as"
    ref="button"
    :style="{ height: `${height}px` }"
    :class="{ 'loading load-more-overlay': modelValue }"
  >
    <slot v-if="!modelValue" />
  </component>
</template>

<script>
export default {
  props: ["modelValue", "as"],

  data() {
    return {
      height: null,
    };
  },

  mounted() {
    this.height = $(this.$refs.button).outerHeight(true);
  },
};
</script>

<style scoped>
.load-more-overlay::before {
  content: unset !important;
}
.loading:not(.load-more-overlay),
.load-more-overlay.loading::after {
  border-radius: 50% !important;
  border-left-color: #26c;
}
</style>