<template>
  <div :class="{ 'is-invalid': errorMessage }" class="form-group">
    <slot />
    <div
      v-if="errorMessage"
      class="alert-danger alert-simple border-no font-weight-normal mt-1"
      style="font-size: 13px"
    >
      {{ errorMessage }}
    </div>
  </div>
</template>

<script>
export default {
  props: {
    errorMessage: {
      type: String,
      default: "",
      required: false,
    },
  },
};
</script>

