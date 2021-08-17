<template>
  <header :class="{ 'header-border': !isHome }" class="header">
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

  data() {
    return { isHome: true };
  },

  mounted() {
    this.isHome = route().current("home");

    this.$EMITTER.on("inertia-finish", () => {
      this.isHome = route().current("home");
    });
  },
};
</script>