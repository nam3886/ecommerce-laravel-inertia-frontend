<template>
  <div
    class="alert-danger alert-simple border-no font-weight-normal"
    style="font-size: 13px"
  >
    {{ message }}
  </div>
</template>

<script>
export default {
  props: ["message"],
};
</script>
