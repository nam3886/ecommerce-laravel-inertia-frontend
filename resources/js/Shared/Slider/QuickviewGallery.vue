<template>
  <div class="product-gallery">
    <div
      ref="owlCarousel"
      :class="{ 'product-single-carousel owl-carousel': 1 }"
      class="owl-theme owl-nav-inner row cols-1"
    >
      <figure
        v-for="(image, index) in images"
        :key="index"
        class="product-image"
      >
        <img
          :src="image.url"
          :data-zoom-image="image.url"
          :alt="image.name"
          width="580"
          height="580"
        />
      </figure>
    </div>
  </div>
</template>

<script>
import Riode from "@/Riode/";

export default {
  props: ["images"],

  mounted() {
    // Initialize owl carousel
    Riode.slider(this.$refs.owlCarousel);
  },
};
</script>
