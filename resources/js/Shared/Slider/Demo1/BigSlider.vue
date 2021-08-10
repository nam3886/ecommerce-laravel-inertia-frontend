<template>
  <div
    ref="owlCarousel"
    class="
      owl-carousel owl-theme
      row
      owl-dot-inner owl-dot-white
      intro-slider
      animation-slider
      cols-1
      gutter-no
    "
    data-owl-options="{
                        'nav': false,
                        'dots': true,
                        'loop': false,
                        'items': 1,
                        'autoplay': false,
                        'autoplayTimeout': 8000
                    }"
  >
    <div
      class="banner banner-fixed intro-slide1"
      style="background-color: #46b2e8"
    >
      <figure>
        <img
          src="images/demos/demo1/slides/slide1.jpg"
          alt="intro-banner"
          width="1903"
          height="630"
          style="background-color: #34ace5"
        />
      </figure>
      <div class="container">
        <div class="banner-content y-50">
          <h4 class="banner-subtitle font-weight-bold ls-l">
            <span
              class="d-inline-block slide-animate"
              data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.2s'}"
              >Buy 2 Get</span
            >
            <span
              class="
                d-inline-block
                label-star
                bg-white
                text-primary
                slide-animate
              "
              data-animation-options="{'name': 'fadeInRightShorter', 'duration': '1s', 'delay': '.4s'}"
              >1 Free</span
            >
          </h4>
          <h2
            class="
              banner-title
              font-weight-bold
              text-white
              lh-1
              ls-md
              slide-animate
            "
            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1.2s', 'delay': '1s'}"
          >
            Fashionable
          </h2>
          <h3
            class="font-weight-normal lh-1 ls-l text-white slide-animate"
            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1.2s', 'delay': '1s'}"
          >
            Collection
          </h3>
          <p
            class="slide-animate text-white ls-s mb-7"
            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1.2s', 'delay': '1s'}"
          >
            Get Free Shipping on all orders over $99.00
          </p>
          <a
            href="shop.html"
            class="btn btn-dark btn-rounded slide-animate"
            data-animation-options="{'name': 'fadeInUpShorter', 'duration': '1s', 'delay': '1.8s'}"
            >Shop Now<i class="d-icon-arrow-right"></i
          ></a>
        </div>
      </div>
    </div>
    <div
      class="banner banner-fixed intro-slide2"
      style="background-color: #dddee0"
    >
      <figure>
        <img
          src="images/demos/demo1/slides/slide2.jpg"
          alt="intro-banner"
          width="1903"
          height="630"
          style="background-color: #d8d9d9"
        />
      </figure>
      <div class="container">
        <div class="banner-content y-50 ml-auto text-right">
          <h4
            class="banner-subtitle ls-s mb-1 slide-animate"
            data-animation-options="{'name': 'fadeInUp', 'duration': '.7s'}"
          >
            <span class="d-block text-uppercase mb-2">Coming soon</span
            ><strong class="font-weight-semi-bold ls-m">Riode Birthday</strong>
          </h4>
          <h2
            class="
              banner-title
              mb-2
              d-inline-block
              font-weight-bold
              text-primary
              slide-animate
            "
            data-animation-options="{'name': 'fadeInRight', 'duration': '1.2s', 'delay': '.5s'}"
          >
            Sale
          </h2>
          <p
            class="slide-animate font-primary ls-s text-dark mb-4"
            data-animation-options="{'name': 'fadeInUp', 'duration': '1s', 'delay': '1.2s'}"
          >
            Up to 70% off on all products <br />online &amp; Free Shipping over
            $90
          </p>
          <a
            href="shop.html"
            class="btn btn-dark btn-rounded slide-animate"
            data-animation-options="{'name': 'fadeInUp', 'duration': '1s', 'delay': '1.4s'}"
            >Shop Now<i class="d-icon-arrow-right"></i
          ></a>
        </div>
      </div>
    </div>
    <div
      class="banner banner-fixed video-banner intro-slide3"
      style="background-color: #dddee0"
    >
      <figure>
        <video
          src="video/memory-of-a-woman.mp4"
          width="1903"
          height="630"
        ></video>
      </figure>
      <div class="container">
        <div class="banner-content x-50 y-50 text-center">
          <h4
            class="
              banner-subtitle
              text-white text-uppercase
              mb-3
              ls-normal
              slide-animate
            "
            data-animation-options="{'name': 'fadeIn', 'duration': '.7s'}"
          >
            Check out our
          </h4>
          <h2
            class="
              banner-title
              mb-3
              text-white
              font-weight-bold
              text-uppercase
              ls-m
              slide-animate
            "
            data-animation-options="{'name': 'fadeInUp', 'duration': '.7s', 'delay': '.5s'}"
          >
            Summer Season's
          </h2>
          <p
            class="slide-animate mb-7 text-white ls-s font-primary"
            data-animation-options="{'name': 'fadeInUp', 'duration': '1s', 'delay': '.8s'}"
          >
            Up to 50% Off this Season’s &amp; Get free shipping<br />on all
            orders over $199.00
          </p>
          <a
            href="shop.html"
            class="btn btn-dark btn-rounded slide-animate mb-1"
            data-animation-options="{'name': 'fadeInLeft', 'duration': '1s', 'delay': '1.5s'}"
            >Shop Now<i class="d-icon-arrow-right"></i
          ></a>
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