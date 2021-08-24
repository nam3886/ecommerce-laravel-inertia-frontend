<template>
  <div class="product-gallery">
    <div
      ref="owlCarousel"
      :class="{ 'product-single-carousel owl-carousel': 1 }"
      class="owl-theme owl-nav-inner row cols-1 owl-carousel"
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
          width="800"
          height="900"
        />
        <a
          @click.prevent="$EMITTER.emit('show:photoswipe', { images, index })"
          href="#"
          class="product-image-full"
        >
          <i class="d-icon-zoom"></i>
        </a>
      </figure>
    </div>
    <div class="product-thumbs-wrap">
      <div class="product-thumbs">
        <div
          v-for="(image, index) in images"
          :key="index"
          :class="{ active: !index }"
          class="product-thumb"
        >
          <img :src="image.url" :alt="image.name" width="109" height="122" />
        </div>
      </div>
      <button class="thumb-up disabled">
        <i class="fas fa-chevron-left"></i>
      </button>
      <button class="thumb-down disabled">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>
    <slot />
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

