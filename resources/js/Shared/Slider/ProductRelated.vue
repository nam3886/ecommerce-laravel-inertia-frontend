<template>
  <section class="pt-3 mt-10">
    <h2 class="title justify-content-center">Related Products</h2>

    <div
      ref="owlCarousel"
      class="owl-carousel owl-theme owl-nav-full row cols-2 cols-md-3 cols-lg-4"
      data-owl-options="{
        'items': 5,
        'nav': false,
        'loop': false,
        'dots': true,
        'margin': 20,
        'responsive': {
          '0': {
            'items': 2
          },
          '768': {
            'items': 3
          },
          '992': {
            'items': 4,
            'dots': false,
            'nav': true
          }
        }
      }"
    >
      <product
        v-for="(product, index) in products"
        :key="index"
        :product="product"
      />
    </div>
  </section>
</template>

<script>
import Riode from "@/Riode/";
import Product from "@/Shared/ProductElement/Default.vue";

export default {
  props: ["products"],

  components: { Product },

  mounted() {
    // Initialize owl carousel
    Riode.slider(this.$refs.owlCarousel);
  },
};
</script>