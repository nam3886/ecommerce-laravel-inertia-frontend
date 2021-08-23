<template>
  <main class="main single-product">
    <div class="page-content mb-10 pb-6">
      <div class="container">
        <breadcrumb :products="related.data" />
        <div class="row gutter-lg">
          <right-sidebar
            :shop="product.data.shop"
            :ownProducts="ownProducts.data"
          />
          <div class="col-lg-9">
            <alert-added-cart :sku="sku || product.data.sku" />
            <flash-message class="mb-2" />
            <div class="product row mb-4 product-single not-quickview">
              <div class="col-md-6">
                <gallery :images="product.data.gallery.images">
                  <product-label
                    :flag="product.data.flag"
                    :discount="product.data.discount"
                  />
                </gallery>
              </div>
              <div class="col-md-6">
                <detail @update:sku="sku = $event" />
              </div>
            </div>

            <tab />

            <product-related :products="related.data" />
          </div>
        </div>
      </div>
    </div>

    <Head :title="product.data.name" />
  </main>
</template>

<script>
import Layout from "@/Layouts/AppLayout/index.vue";
import { Head } from "@inertiajs/inertia-vue3";
import RightSidebar from "@/Shared/Partials/Product/RightSidebar.vue";
import Gallery from "@/Shared/Slider/Gallery.vue";
import Detail from "@/Shared/Partials/Product/Detail.vue";
import Breadcrumb from "@/Shared/Partials/Product/Breadcrumb.vue";
import ProductRelated from "@/Shared/Slider/ProductRelated.vue";
import Tab from "@/Shared/Partials/Product/Tab.vue";
import ProductLabel from "@/Shared/ProductElement/Label.vue";
import AlertAddedCart from "@/Shared/Alert/AddedCart.vue";
import FlashMessage from "@/Shared/Alert/FlashMessage.vue";
import "@p/vendor/photoswipe/photoswipe.min.css";
import "@p/vendor/photoswipe/default-skin/default-skin.min.css";
import "@r/css/style.css";

export default {
  layout: Layout,

  components: {
    Head,
    RightSidebar,
    Gallery,
    Breadcrumb,
    Detail,
    ProductRelated,
    Tab,
    ProductLabel,
    AlertAddedCart,
    FlashMessage,
  },

  props: {
    product: {
      type: Object,
      require: true,
    },

    related: {
      type: Object,
      require: true,
    },

    ownProducts: {
      type: Object,
      require: true,
    },
  },

  data() {
    return {
      sku: null,
    };
  },
};
</script>