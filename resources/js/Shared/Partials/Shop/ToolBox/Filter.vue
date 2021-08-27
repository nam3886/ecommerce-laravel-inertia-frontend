<template>
  <div
    @click.stop="isOpened = !isOpened"
    :class="{ opened: isOpened }"
    class="toolbox-item select-menu"
  >
    <a @click.prevent="" class="select-menu-toggle" href="#">{{ label }}</a>
    <ul class="filter-items filter-price">
      <li
        v-for="(option, index) in options"
        :key="index"
        @click.prevent="toggleSelection(option.value)"
        :class="{ active: isSelected(option.value) }"
      >
        <a @click.prevent="" href="#">{{ option.text }}</a>
      </li>
    </ul>
  </div>
</template>

<script>
import { ref, computed } from "vue";

export default {
  props: ["modelValue", "options", "label"],

  setup(props, { emit }) {
    const isOpened = ref(false);
    const { options, label } = props;
    const selectedList = computed({
      get: () => props.modelValue || [],
      set: (newValue) => emit("update:modelValue", newValue),
    });

    function isSelected(value) {
      return selectedList.value.includes(value);
    }

    function toggleSelection(selection) {
      const { value } = selectedList;

      if (isSelected(selection)) {
        let index = value.findIndex((selected) => selected.includes(selection));
        value.splice(index, 1);
      } else {
        value.push(selection);
      }

      selectedList.value = value;
    }

    return {
      isOpened,
      options,
      label,
      isSelected,
      toggleSelection,
    };
  },
};
</script>