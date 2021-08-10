<template>
  <Link :href="route('product.show', slug)">
    <slot />
  </Link>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
  props: ["slug"],

  components: { Link },
};
</script>

<style>
</style>