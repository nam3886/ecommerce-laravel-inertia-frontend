<template>
  <div class="search-box mr-2 mb-1 mb-md-0 d-inline-block">
    <div class="position-relative">
      <input
        type="search"
        placeholder="Search..."
        class="form-control shadow-sm border-0"
        @input="onChange($event.target.value)"
        :value="value"
      />
      <i class="bx bx-search-alt search-icon"></i>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    value: {
      type: String,
      default: "",
      required: false,
    },

    onChange: {
      type: Function,
      required: true,
    },
  },
};
</script>
