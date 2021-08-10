<template>
  <datepicker
    v-model="range"
    mode="dateTime"
    :model-config="modelConfig"
    is-range
    is24hr
  >
    <template v-slot="{ inputValue, inputEvents, isDragging }">
      <div class="d-flex justify-content-start align-items-center">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" style="color: #718096">
              <i class="mdi mdi-calendar-minus"></i>
            </span>
          </div>
          <input
            :value="inputValue.start"
            v-on="inputEvents.start"
            :class="isDragging ? 'text-gray-600' : 'text-gray-900'"
            placeholder="start"
            class="form-control"
          />
        </div>
        <span class="m-2">
          <svg
            viewBox="0 0 24 24"
            style="
              stroke: currentColor;
              color: rgba(113, 128, 150);
              height: 1rem;
            "
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M14 5l7 7m0 0l-7 7m7-7H3"
            />
          </svg>
        </span>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" style="color: #718096">
              <i class="mdi mdi-calendar-minus"></i>
            </span>
          </div>
          <input
            :value="inputValue.end"
            v-on="inputEvents.end"
            :class="isDragging ? 'text-gray-600' : 'text-gray-900'"
            placeholder="end"
            class="form-control"
          />
        </div>
      </div>
    </template>
  </datepicker>
</template>

<script>
import Datepicker from "v-calendar/lib/components/date-picker.umd";

export default {
  components: { Datepicker },

  props: {
    value: {
      type: Object,
      require: true,
    },
  },

  data() {
    return {
      modelConfig: {
        // type: "number", // timestamp
        mask: "YYYY-MM-DD HH:mm:ss",
      },
    };
  },

  computed: {
    range: {
      get() {
        return this.value;
      },

      set(range) {
        this.$emit("input", { ...this.value, ...range });
      },
    },
  },
};
</script>