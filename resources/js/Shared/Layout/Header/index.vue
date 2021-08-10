<template>
  <header :class="{ 'header-border': !isHome }" class="header">
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

  data() {
    return { isHome: true };
  },

  mounted() {
    this.isHome = route().current("home");

    this.emitter.on("inertia-finish", () => {
      this.isHome = route().current("home");
    });
  },
};
</script>