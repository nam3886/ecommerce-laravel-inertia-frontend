<template>
  <div class="toolbox-item toolbox-sort select-menu">
    <select v-model="sort" class="form-control ls-normal">
      <option value="default">Default sorting</option>
      <option value="popularity">Most popular</option>
      <option value="rating">Average rating</option>
      <option value="date">Latest</option>
      <option value="-price">Sort forward price low</option>
      <option value="price">Sort forward price high</option>
    </select>
  </div>
</template>

<script>
import { computed } from "vue";

export default {
  props: ["modelValue"],

  setup(props, { emit }) {
    const sort = computed({
      get: () => props.modelValue,
      set: (val) => emit("update:modelValue", val),
    });

    return { sort };
  },
};
</script>
