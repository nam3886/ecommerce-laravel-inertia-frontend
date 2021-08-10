<template>
  <div class="form-group d-flex">
    <select
      :value="perPage"
      @change="onChange($event.target.value)"
      class="w-auto custom-select shadow-sm border-0"
    >
      <option value="5">Show 5 Records</option>
      <option value="10">Show 10 Records</option>
      <option value="15">Show 15 Records</option>
      <option value="25">Show 25 Records</option>
      <option value="50">Show 50 Records</option>
    </select>
  </div>
</template>

<script>
export default {
  props: {
    perPage: {
      type: Number,
      required: true,
    },
    onChange: {
      type: Function,
      required: true,
    },
  },
};
</script>
