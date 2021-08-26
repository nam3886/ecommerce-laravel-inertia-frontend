<template>
  <div class="brand-wrapper mb-8">
    <div
      ref="owlCarousel"
      class="
        owl-carousel owl-theme
        row
        cols-xl-7 cols-lg-6 cols-md-4 cols-sm-3 cols-2
      "
      data-owl-options="{
          'nav': false,
          'dots': false,
          'magin': 0,
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
                  'items': 6
              },
              '1200': {
                  'items': 7
              }
          }
      }"
    >
      <figure>
        <img
          src="images/demos/demo-market1/brand/shop/1.jpg"
          alt="Brand"
          width="197"
          height="93"
        />
      </figure>
      <figure>
        <img
          src="images/demos/demo-market1/brand/shop/2.jpg"
          alt="Brand"
          width="213"
          height="100"
        />
      </figure>
      <figure>
        <img
          src="images/demos/demo-market1/brand/shop/3.jpg"
          alt="Brand"
          width="213"
          height="100"
        />
      </figure>
      <figure>
        <img
          src="images/demos/demo-market1/brand/shop/4.jpg"
          alt="Brand"
          width="213"
          height="100"
        />
      </figure>
      <figure>
        <img
          src="images/demos/demo-market1/brand/shop/5.jpg"
          alt="Brand"
          width="213"
          height="100"
        />
      </figure>
      <figure>
        <img
          src="images/demos/demo-market1/brand/shop/6.jpg"
          alt="Brand"
          width="213"
          height="100"
        />
      </figure>
      <figure>
        <img
          src="images/demos/demo-market1/brand/shop/7.jpg"
          alt="Brand"
          width="213"
          height="100"
        />
      </figure>
    </div>
  </div>
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
