<template>
  <div v-show="hasFiltersEnabled" class="mb-4">
    <div
      v-for="(search, key) in enabledFilters"
      :key="key"
      class="form-group d-flex my-2"
    >
      <div class="position-relative w-100">
        <input
          @input="onChange(search.key, $event.target.value)"
          :value="search.value"
          :ref="search.key"
          :placeholder="`filter by ${search.label}...`"
          type="text"
          class="form-control shadow-sm border-0"
        />
        <button @click="onRemove(search.key)" type="button" class="btn">
          <i class="mdi mdi-close"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import filter from "lodash-es/filter";

export default {
  props: {
    rows: {
      type: Object,
      required: true,
    },

    new: {
      type: Array,
      default: () => [],
      required: false,
    },

    onChange: {
      type: Function,
      required: true,
    },

    onRemove: {
      type: Function,
      required: true,
    },
  },

  methods: {
    searchOptionIsEnabled(key) {
      return this.rows[key].enabled || this.new.includes(key);
    },

    focus(key) {
      const keyRef = this.$refs[key];

      if (keyRef.length === 1) {
        return keyRef[0].focus();
      }

      keyRef.focus();
    },
  },

  computed: {
    hasFiltersEnabled() {
      return Object.keys(this.enabledFilters || {}).length > 0;
    },

    enabledFilters() {
      const filters = filter(this.rows, (search) => {
        if (search.key === "global") {
          return false;
        }

        return this.searchOptionIsEnabled(search.key);
      });

      return filters;
    },
  },
};
</script>

<style scoped>
button {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  line-height: 1;
}
button > i {
  font-size: 18px;
}
button:hover > i {
  color: #556ee6;
  -webkit-transform: scale(1.5);
  transform: scale(1.5);
}
</style>
