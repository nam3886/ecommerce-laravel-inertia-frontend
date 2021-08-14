<template>
  <section
    class="mt-2 pb-6 pt-10 pb-md-10 appear-animate"
    data-animation-options="{
                    'delay': '.3s'
                }"
  >
    <h2 class="title d-none">Our Brand</h2>
    <div class="container">
      <div
        ref="owlCarousel"
        class="
          owl-carousel owl-theme
          row
          brand-carousel
          cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2
        "
        data-owl-options="{
          'nav': false,
          'dots': false,
          'autoplay': true,
          'margin': 20,
          'loop': true,
          'responsive': {
              '0': {
                  'items': 2
              },
              '576': {
                  'items': 3
              },
              '768': {
                  'items': 4
              },
              '992': {
                  'items': 5
              },
              '1200': {
                  'items': 6
              }
          }
      }"
      >
        <figure>
          <img src="images/brands/1.png" alt="brand" width="180" height="100" />
        </figure>
        <figure>
          <img src="images/brands/2.png" alt="brand" width="180" height="100" />
        </figure>
        <figure>
          <img src="images/brands/3.png" alt="brand" width="180" height="100" />
        </figure>
        <figure>
          <img src="images/brands/4.png" alt="brand" width="180" height="100" />
        </figure>
        <figure>
          <img src="images/brands/5.png" alt="brand" width="180" height="100" />
        </figure>
        <figure>
          <img src="images/brands/6.png" alt="brand" width="180" height="100" />
        </figure>
      </div>
    </div>
  </section>
</template>

<script>
import Riode from "@/Riode/";

export default {
  mounted() {
    // Initialize owl carousel
    Riode.slider(this.$refs.owlCarousel);
  },
};
</script>