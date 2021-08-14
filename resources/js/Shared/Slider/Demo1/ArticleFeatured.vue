<template>
  <section
    class="blog-post-wrapper mt-6 mt-md-10 pt-7 appear-animate"
    data-animation-options="{'name': 'fadeIn', 'duration': '1s'}"
  >
    <div class="container">
      <h2 class="title title-center">Featured Articles</h2>
      <div
        ref="owlCarousel"
        class="
          owl-carousel owl-theme
          post-slider
          row
          cols-lg-3 cols-sm-2 cols-1
        "
        data-owl-options="{
            'nav': false,
            'dots': true,
            'margin': 20,
            'responsive': {
                '0': {
                    'items': 1
                },
                '576': {
                    'items': 2
                },
                '992': {
                    'items': 3,
                    'dots': false
                }
            }
        }"
      >
        <div class="blog-post mb-4">
          <article class="post post-frame overlay-zoom">
            <figure class="post-media">
              <a href="post-single.html">
                <img
                  src="images/blog/frame/1.jpg"
                  alt="Blog post"
                  width="340"
                  height="206"
                  style="background-color: #919fbc"
                />
              </a>
              <div class="post-calendar">
                <span class="post-day">19</span>
                <span class="post-month">JAN</span>
              </div>
            </figure>
            <div class="post-details">
              <h4 class="post-title">
                <a href="post-single.html">20% Off Coupon for Cyber Week</a>
              </h4>
              <p class="post-content">
                Lorem ipsum dolor sit amet,onadipiscing elit, sedsd doeiu smod
                tempo...
              </p>
              <a
                href="post-single.html"
                class="btn btn-primary btn-link btn-underline"
                >Read More<i class="d-icon-arrow-right"></i
              ></a>
            </div>
          </article>
        </div>
        <div class="blog-post mb-4">
          <article class="post post-frame overlay-zoom">
            <figure class="post-media">
              <a href="post-single.html">
                <img
                  src="images/blog/frame/2.jpg"
                  alt="Blog post"
                  width="340"
                  height="206"
                  style="background-color: #e5e6e6"
                />
              </a>
              <div class="post-calendar">
                <span class="post-day">19</span>
                <span class="post-month">JAN</span>
              </div>
            </figure>
            <div class="post-details">
              <h4 class="post-title">
                <a href="post-single.html">20% Off Coupon for Cyber Week</a>
              </h4>
              <p class="post-content">
                Lorem ipsum dolor sit amet,onadipiscing elit, sedsd doeiu smod
                tempo...
              </p>
              <a
                href="post-single.html"
                class="btn btn-primary btn-link btn-underline"
                >Read More<i class="d-icon-arrow-right"></i
              ></a>
            </div>
          </article>
        </div>
        <div class="blog-post mb-4">
          <article class="post post-frame overlay-zoom">
            <figure class="post-media">
              <a href="post-single.html">
                <img
                  src="images/blog/frame/3.jpg"
                  alt="Blog post"
                  width="340"
                  height="206"
                  style="background-color: #eaeef1"
                />
              </a>
              <div class="post-calendar">
                <span class="post-day">19</span>
                <span class="post-month">JAN</span>
              </div>
            </figure>
            <div class="post-details">
              <h4 class="post-title">
                <a href="post-single.html">20% Off Coupon for Cyber Week</a>
              </h4>
              <p class="post-content">
                Lorem ipsum dolor sit amet,onadipiscing elit, sedsd doeiu smod
                tempo...
              </p>
              <a
                href="post-single.html"
                class="btn btn-primary btn-link btn-underline"
                >Read More<i class="d-icon-arrow-right"></i
              ></a>
            </div>
          </article>
        </div>
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