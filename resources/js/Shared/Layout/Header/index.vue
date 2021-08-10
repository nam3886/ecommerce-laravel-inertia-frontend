<template>
  <header class="header">
    <header-top />
    <header-middle />
    <header-bottom />
  </header>
</template>

<script>
import HeaderTop from "@/Shared/Layout/Header/Top.vue";
import HeaderMiddle from "@/Shared/Layout/Header/Middle.vue";
import HeaderBottom from "@/Shared/Layout/Header/Bottom.vue";

export default {
  components: { HeaderTop, HeaderMiddle, HeaderBottom },
};
</script>