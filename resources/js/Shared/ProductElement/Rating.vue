<template>
  <div class="ratings-full">
    <span :style="{ width }" class="ratings"></span>
    <span class="tooltiptext tooltip-top"></span>
  </div>
</template>

<script>
export default {
  props: ["width"],
};
</script>