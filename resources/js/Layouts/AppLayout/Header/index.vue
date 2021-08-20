<template>
  <header
    :class="{
      'header-border':
        !route().current('home') && !route().current('checkout.index'),
    }"
    class="header"
  >
    <header-top />
    <header-middle />
    <header-bottom />
  </header>
</template>

<script>
import HeaderTop from "@/Layouts/AppLayout/Header/Top.vue";
import HeaderMiddle from "@/Layouts/AppLayout/Header/Middle.vue";
import HeaderBottom from "@/Layouts/AppLayout/Header/Bottom.vue";

export default {
  components: { HeaderTop, HeaderMiddle, HeaderBottom },
};
</script>