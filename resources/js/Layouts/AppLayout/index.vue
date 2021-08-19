<template>
  <div>
    <div class="page-wrapper">
      <header-layout />

      <slot />

      <button @click="$EMITTER.emit('show-popup:user-info')">clecik</button>

      <footer-layout />
    </div>

    <sticky-footer />

    <scroll-top />

    <photoshopwipe v-if="route().current('product.show')" />

    <mobile-menu />

    <newsletter-popup />

    <popup-login />

    <popup-quickview />

    <popup-user-info />

    <minipopup />

    <Head>
      <link
        rel="icon"
        type="image/png"
        :href="$BASE_URL + '/images/icons/favicon.png'"
      />
    </Head>
  </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";
import Riode from "@/Riode/";
import HeaderLayout from "@/Layouts/AppLayout/Header/";
import FooterLayout from "@/Layouts/AppLayout/Footer.vue";
import MobileMenu from "@/Layouts/AppLayout/MobileMenu.vue";
import NewsletterPopup from "@/Layouts/AppLayout/NewsletterPopup.vue";
import ScrollTop from "@/Layouts/AppLayout/ScrollTop.vue";
import StickyFooter from "@/Layouts/AppLayout/StickyFooter.vue";
import Photoshopwipe from "@/Layouts/AppLayout/Photoshopwipe.vue";
import PopupLogin from "@/Shared/Popup/Login/";
import PopupQuickview from "@/Shared/Popup/Quickview/";
import PopupUserInfo from "@/Shared/Popup/UserInfo/";
import Minipopup from "@/Shared/Popup/Mini/";

export default {
  components: {
    Head,
    HeaderLayout,
    FooterLayout,
    MobileMenu,
    NewsletterPopup,
    ScrollTop,
    StickyFooter,
    Photoshopwipe,
    PopupLogin,
    PopupQuickview,
    PopupUserInfo,
    Minipopup,
  },

  mounted() {
    this.initRiode();

    Inertia.on("finish", (event) => {
      this.$EMITTER.emit("inertia-finish", event);
      this.initRiode();
    });

    setInterval(() => this.$EMITTER.emit("show-popup:purchased", {}), 60000);
  },

  methods: {
    initRiode() {
      $("body").toggleClass("home", this.route().current("home"));

      Riode.prepare();
      Riode.status = "loaded";
      Riode.$body.addClass("loaded");
      Riode.$window.trigger("riode_load");

      Riode.call(Riode.initLayout);
      Riode.call(Riode.init);
      Riode.$window.trigger("riode_complete");
      Riode.refreshSidebar();
    },
  },
};
</script>
