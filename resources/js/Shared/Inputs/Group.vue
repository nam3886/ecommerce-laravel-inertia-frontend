<template>
  <div :class="{ 'is-invalid': errorMessage }" class="form-group">
    <slot />
    <div v-show="errorMessage" :class="{ 'invalid-feedback': errorMessage }">
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

<style scoped>
.form-group.is-invalid .invalid-feedback {
  display: block;
}
.form-control.is-valid:focus,
.was-validated .form-control:valid:focus,
.custom-select:focus {
  box-shadow: unset;
}
.form-group.is-invalid .form-control,
.form-group.is-invalid .dropzone,
.form-group.is-invalid .custom-select {
  border-color: #f46a6a;
  padding-right: calc(1.5em + 0.94rem);
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23f46a6a' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23f46a6a' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E");
  background-repeat: no-repeat;
  background-position: right calc(0.375em + 0.235rem) center;
  background-size: calc(0.75em + 0.47rem) calc(0.75em + 0.47rem);
}
</style>