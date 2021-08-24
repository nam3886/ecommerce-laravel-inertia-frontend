<template>
  <div ref="pswp" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <!-- Background of PhotoSwipe. It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">
      <!-- Container that holds slides.
			PhotoSwipe keeps only 3 of them in the DOM to save memory.
			Don't modify these 3 pswp__item elements, data is added later on. -->
      <div class="pswp__container">
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
      </div>

      <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
      <div class="pswp__ui pswp__ui--hidden">
        <div class="pswp__top-bar">
          <!--  Controls are self-explanatory. Order can be changed. -->

          <div class="pswp__counter"></div>

          <button
            class="pswp__button pswp__button--close"
            aria-label="Close (Esc)"
          ></button>
          <button
            class="pswp__button pswp__button--zoom"
            aria-label="Zoom in/out"
          ></button>

          <div class="pswp__preloader">
            <div class="loading-spin"></div>
          </div>
        </div>

        <div
          class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"
        >
          <div class="pswp__share-tooltip"></div>
        </div>

        <button
          class="pswp__button--arrow--left"
          aria-label="Previous (arrow left)"
        ></button>
        <button
          class="pswp__button--arrow--right"
          aria-label="Next (arrow right)"
        ></button>

        <div class="pswp__caption">
          <div class="pswp__caption__center"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PhotoSwipe from "@p/vendor/photoswipe/photoswipe.min.js";
import PhotoSwipeUI_Default from "@p/vendor/photoswipe/photoswipe-ui-default.min.js";

export default {
  mounted() {
    this.$EMITTER.on("show:photoswipe", this.handleShowPhotoswipe);
  },

  methods: {
    handleShowPhotoswipe({ images, index }) {
      images = images.map((image) => ({
        src: image.url,
        w: 800,
        h: 899,
        title: image.name,
      }));

      new PhotoSwipe(this.$refs.pswp, PhotoSwipeUI_Default, images, {
        index,
        closeOnScroll: false,
        history: false,
      }).init();
    },
  },
};
</script>

<style>
</style>