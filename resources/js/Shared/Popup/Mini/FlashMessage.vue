<template>
  <div class="alert alert-warning alert-dark alert-inline">
    <h4 class="alert-title">Warning :</h4>
    {{ message }}
    <button type="button" class="btn btn-link btn-close">
      <i class="d-icon-times"></i>
    </button>
  </div>
</template>

<script>
export default {
  props: ["message"],
};
</script>
