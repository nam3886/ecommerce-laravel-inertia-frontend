<template>
  <select2 v-model="valueConfirm" :options="options" />
</template>

<script>
import Select2 from "@/Shared/Inputs/Select/Select2.vue";

export default {
  props: ["value"],

  components: { Select2 },

  data() {
    return {
      options: [
        { id: true, text: "Yes" },
        { id: false, text: "No" },
      ],
    };
  },

  computed: {
    valueConfirm: {
      get() {
        return this.value;
      },
      
      set(valueConfirm) {
        this.$emit("input", valueConfirm);
      },
    },
  },
};
</script>

