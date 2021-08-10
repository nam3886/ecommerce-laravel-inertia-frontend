<template>
  <main class="main">
    <div class="page-content">
      <section class="intro-section">
        <big-slider />

        <service-slider />
      </section>

      <category />

      <product-best-sell-slider :products="bestSellProduct" />

      <banner />

      <product-featured-slider :products="featuredProduct" />

      <big-banner />

      <article-featured-slider />

      <brand-slider />

      <sale-product />
    </div>

    <Head title="Home" />
  </main>
</template>

<script>
import Layout from "@/Shared/Layout/";
import { Head } from "@inertiajs/inertia-vue3";
import BigSlider from "@/Shared/Slider/Demo1/BigSlider.vue";
import ServiceSlider from "@/Shared/Slider/Demo1/Service.vue";
import ProductBestSellSlider from "@/Shared/Slider/Demo1/ProductBestSell.vue";
import ProductFeaturedSlider from "@/Shared/Slider/Demo1/ProductFeatured.vue";
import ArticleFeaturedSlider from "@/Shared/Slider/Demo1/ArticleFeatured.vue";
import BrandSlider from "@/Shared/Slider/Demo1/Brand.vue";
import Category from "@/Shared/Partials/Home/Demo1/Category.vue";
import Banner from "@/Shared/Partials/Home/Demo1/Banner.vue";
import BigBanner from "@/Shared/Partials/Home/Demo1/BigBanner.vue";
import SaleProduct from "@/Shared/Partials/Home/Demo1/SaleProduct.vue";
import "@r/css/demo1.min.css";

export default {
  layout: Layout,

  props: ["featuredProduct", "bestSellProduct"],

  components: {
    Head,
    BigSlider,
    ServiceSlider,
    ProductBestSellSlider,
    ProductFeaturedSlider,
    ArticleFeaturedSlider,
    BrandSlider,
    Category,
    Banner,
    BigBanner,
    SaleProduct,
  },
};
</script>