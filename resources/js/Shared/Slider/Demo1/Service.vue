<template>
  <div class="container mt-6 appear-animate">
    <div class="service-list">
      <div
        ref="owlCarousel"
        class="owl-carousel owl-theme row cols-lg-3 cols-sm-2 cols-1"
        data-owl-options="{
                                    'items': 3,
                                    'nav': false,
                                    'dots': false,
                                    'loop': true,
                                    'autoplay': false,
                                    'autoplayTimeout': 5000,
                                    'responsive': {
                                        '0': {
                                            'items': 1
                                        },
                                        '576': {
                                            'items': 2
                                        },
                                        '768': {
                                            'items': 3,
                                            'loop': false
                                        }
                                    }
                                }"
      >
        <div
          class="icon-box icon-box-side icon-box1 appear-animate"
          data-animation-options="{
                                        'name': 'fadeInRightShorter',
                                        'delay': '.3s'
                                    }"
        >
          <i class="icon-box-icon d-icon-truck"></i>
          <div class="icon-box-content">
            <h4 class="icon-box-title text-capitalize ls-normal lh-1">
              Free Shipping &amp; Return
            </h4>
            <p class="ls-s lh-1">Free shipping on orders over $99</p>
          </div>
        </div>

        <div
          class="icon-box icon-box-side icon-box2 appear-animate"
          data-animation-options="{
                                        'name': 'fadeInRightShorter',
                                        'delay': '.4s'
                                    }"
        >
          <i class="icon-box-icon d-icon-service"></i>
          <div class="icon-box-content">
            <h4 class="icon-box-title text-capitalize ls-normal lh-1">
              Customer Support 24/7
            </h4>
            <p class="ls-s lh-1">Instant access to perfect support</p>
          </div>
        </div>

        <div
          class="icon-box icon-box-side icon-box3 appear-animate"
          data-animation-options="{
                                        'name': 'fadeInRightShorter',
                                        'delay': '.5s'
                                    }"
        >
          <i class="icon-box-icon d-icon-secure"></i>
          <div class="icon-box-content">
            <h4 class="icon-box-title text-capitalize ls-normal lh-1">
              100% Secure Payment
            </h4>
            <p class="ls-s lh-1">We ensure secure payment!</p>
          </div>
        </div>
      </div>
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