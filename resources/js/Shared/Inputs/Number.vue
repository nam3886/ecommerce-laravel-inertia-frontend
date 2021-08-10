<template>
  <div class="input-group">
    <button
      @mousedown="decrease"
      @mouseleave="stop"
      @mouseup="stop"
      @touchstart="decrease"
      @touchend="stop"
      @touchcancel="stop"
      type="button"
      class="quantity-minus d-icon-minus"
    ></button>
    <input
      v-model.number="valueNumber"
      :max="max"
      :min="min"
      pattern="\d*"
      type="number"
      class="quantity form-control"
    />
    <button
      @mousedown="increase"
      @mouseleave="stop"
      @mouseup="stop"
      @touchstart="increase"
      @touchend="stop"
      @touchcancel="stop"
      type="button"
      class="quantity-plus d-icon-plus"
    ></button>
  </div>
</template>

<script>
export default {
  props: ["modelValue", "min", "max"],

  emits: ["update:modelValue", "reach:minimum", "reach:max"],

  data() {
    return { interval: false, time: 100 };
  },

  watch: {
    valueNumber(valueNumber) {
      if (valueNumber >= this.max) {
        this.stop();
        this.valueNumber = this.max;
      }

      if (valueNumber <= this.min) {
        this.stop();
        this.valueNumber = this.min;
      }
    },
  },

  computed: {
    valueNumber: {
      get() {
        return this.modelValue;
      },

      set(valueNumber) {
        this.$emit("update:modelValue", valueNumber);

        if (valueNumber <= this.min) this.$emit("reach:minimum");

        if (valueNumber >= this.max) this.$emit("reach:max");
      },
    },
  },

  methods: {
    increase() {
      if (!this.interval) {
        this.interval = setInterval(() => this.valueNumber++, this.time);
      }
    },

    decrease() {
      if (!this.interval) {
        this.interval = setInterval(() => this.valueNumber--, this.time);
      }
    },

    stop() {
      clearInterval(this.interval);
      this.interval = false;
    },
  },
};
</script>

<style scoped>
button:disabled {
  cursor: not-allowed;
}
</style>