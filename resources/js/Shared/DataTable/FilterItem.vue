<template>
  <div class="dropdown">
    <button
      class="btn btn-white waves-effect shadow-sm dropdown-toggle"
      type="button"
      id="dropdownDisplayColumn"
      data-toggle="dropdown"
      aria-haspopup="true"
      aria-expanded="true"
      ref="dropdown"
    >
      <svg
        :class="{
          'text-gray': !hasEnabledFilter,
          'text-green': hasEnabledFilter,
        }"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          fill-rule="evenodd"
          d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
          clip-rule="evenodd"
        ></path>
      </svg>
    </button>
    <div
      @click="$event.stopPropagation()"
      ref="dropdownMenu"
      class="dropdown-menu"
      aria-labelledby="dropdownDisplayColumn"
      x-placement="bottom-start"
    >
      <a
        v-for="filter in filters"
        :key="filter.key"
        class="dropdown-item"
        href="#"
      >
        <div class="form-group">
          <label class="col-form-label">{{ filter.label }}</label>
          <select
            :value="filter.value"
            @change="onChange(filter.key, $event.target.value)"
            class="form-control"
          >
            <option
              v-for="(option, key) in filter.options"
              :value="key"
              :key="key"
            >
              {{ option }}
            </option>
          </select>
        </div>
      </a>
    </div>
  </div>
</template>

<script>
import find from "lodash-es/find";

export default {
  props: {
    filters: {
      type: Object,
      required: true,
    },

    onChange: {
      type: Function,
      required: true,
    },
  },

  computed: {
    hasEnabledFilter() {
      return find(
        this.filters,
        (filter, key) => filter.value != "" && filter.value != null
      )
        ? true
        : false;
    },
  },
};
</script>

<style scoped>
.dropdown-menu {
  position: absolute;
  transform: translate3d(0px, 36px, 0px);
  top: 0px;
  left: 0px;
  will-change: transform;
}
svg {
  width: 20px;
}
svg.text-gray {
  color: rgba(156, 163, 175, 1);
}
svg.text-green {
  color: rgba(52, 211, 153, 1);
}
.btn-white {
  background-color: #fff;
}
.dropdown-item > .custom-control.custom-switch {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0;
}
.dropdown-item {
  min-width: 200px;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}
.dropdown-item:not(:last-child) {
  border-bottom: 1px solid rgb(229, 231, 235);
}
.dropdown-item > .custom-control.custom-switch > div {
  display: flex;
}
</style>
