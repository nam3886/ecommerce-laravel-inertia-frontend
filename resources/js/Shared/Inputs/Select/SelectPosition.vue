<template>
  <select2 v-model="valuePosition" :options="options" />
</template>

<script>
import Select2 from "@/Shared/Inputs/Select/Select2.vue";

export default {
  props: ["value"],

  components: { Select2 },

  data() {
    return {
      options: [
        { id: "slider", text: "slider" },
        { id: "body1", text: "body1" },
        { id: "body2", text: "body2" },
        { id: "body3", text: "body3" },
        { id: "bottom", text: "bottom" },
        { id: "other", text: "other" },
      ],
    };
  },

  computed: {
    valuePosition: {
      get() {
        return this.value;
      },
      
      set(valuePosition) {
        this.$emit("input", valuePosition);
      },
    },
  },
};
</script>