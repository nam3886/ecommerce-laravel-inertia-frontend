<template>
  <a
    @click.prevent="$EMITTER.emit('show-popup:quickview', product)"
    title="Quick View"
    href="#"
  >
    <slot />
  </a>
</template>

<script>
export default {
  props: ["product"],
};
</script>

