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

  computed: {
    valueNumber: {
      get() {
        return this.modelValue;
      },

      set(valueNumber) {
        valueNumber = this.makeNumberCorrect(valueNumber);

        if (valueNumber != this.modelValue) {
          this.$emit("update:modelValue", valueNumber);
        }
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

    isMax(value) {
      return value >= this.max;
    },

    isMin(value) {
      return value <= this.min;
    },

    makeNumberCorrect(value) {
      if (this.isMax(value) || this.isMin(value)) {
        const event = this.isMax(value) ? "reach:max" : "reach:minimum";

        value = this.isMax(value) ? this.max : this.min;

        this.stop();

        this.$forceUpdate();

        this.$emit(event);
      }

      return value;
    },
  },
};
</script>

<style scoped>
button:disabled {
  cursor: not-allowed;
}
</style>