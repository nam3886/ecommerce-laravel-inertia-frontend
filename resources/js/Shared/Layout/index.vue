<template>
  <div>
    <div class="page-wrapper">
      <header-layout />

      <slot />

      <footer-layout />
    </div>

    <sticky-footer />

    <scroll-top />

    <photoshopwipe v-if="route().current('product.show')" />

    <mobile-menu />

    <newsletter-popup />

    <popup-login />

    <popup-quickview />

    <minipopup />

    <Head>
      <link
        rel="icon"
        type="image/png"
        :href="$baseUrl + '/images/icons/favicon.png'"
      />
    </Head>
  </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { Head } from "@inertiajs/inertia-vue3";
import Riode from "@/Riode/";
import HeaderLayout from "@/Shared/Layout/Header/";
import FooterLayout from "@/Shared/Layout/Footer.vue";
import MobileMenu from "@/Shared/Layout/MobileMenu.vue";
import NewsletterPopup from "@/Shared/Layout/NewsletterPopup.vue";
import ScrollTop from "@/Shared/Layout/ScrollTop.vue";
import StickyFooter from "@/Shared/Layout/StickyFooter.vue";
import Photoshopwipe from "@/Shared/Layout/Photoshopwipe.vue";
import PopupLogin from "@/Shared/Popup/Login/";
import PopupQuickview from "@/Shared/Popup/Quickview/";
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
    Minipopup,
  },

  mounted() {
    this.initRiode();

    Inertia.on("finish", (event) => {
      this.emitter.emit("inertia-finish", event);
      this.initRiode();
    });

    setInterval(() => this.emitter.emit("show-popup:purchased", {}), 60000);
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
