<template>
  <section
    class="product-wrapper container appear-animate mt-6 mt-md-10 pt-4 pb-8"
    data-animation-options="{ 'delay' : '.3s' }"
  >
    <h2 class="title title-center mb-5">Best Sellers</h2>
    <div
      ref="owlCarousel"
      class="owl-carousel owl-theme row owl-nav-full cols-2 cols-md-3 cols-lg-4"
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
        v-for="product in products.data"
        :key="product.id"
        :product="product"
      />
    </div>
  </section>
</template>

<script>
import Riode from "@/Riode/";
import Product from "@/Shared/ProductElement/Center.vue";

export default {
  props: ["products"],

  components: { Product },

  mounted() {
    // Initialize owl carousel
    Riode.slider(this.$refs.owlCarousel);
  },
};
</script>