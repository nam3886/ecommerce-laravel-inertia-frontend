<template>
  <aside>
    <div class="sidebar-overlay">
      <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
    </div>
    <a href="#" class="sidebar-toggle"><i class="fas fa-chevron-left"></i></a>
    <div class="sidebar-content">
      <div class="sticky-sidebar">
        <div class="service-list mb-4">
          <div class="icon-box icon-box-side icon-box3">
            <span class="icon-box-icon">
              <i class="d-icon-secure"></i>
            </span>
            <div class="icon-box-content">
              <h4 class="icon-box-title text-capitalize">Secured Payment</h4>
              <p>We secure payment!</p>
            </div>
          </div>
          <div class="icon-box icon-box-side icon-box1">
            <span class="icon-box-icon">
              <i class="d-icon-truck"></i>
            </span>
            <div class="icon-box-content">
              <h4 class="icon-box-title text-capitalize">Free Shipping</h4>
              <p>For all orders over $99</p>
            </div>
          </div>
          <div class="icon-box icon-box-side icon-box2">
            <span class="icon-box-icon">
              <i class="d-icon-money"></i>
            </span>
            <div class="icon-box-content">
              <h4 class="icon-box-title text-capitalize">Money Back</h4>
              <p>Any back within 30 days</p>
            </div>
          </div>
        </div>
        <div class="banner banner-fixed mb-7">
          <figure>
            <img
              :src="`${$baseUrl}/images/product/product-banner.jpg`"
              alt="banner"
              width="280"
              height="320"
            />
          </figure>
          <div class="banner-content text-center">
            <h5 class="banner-subtitle ls-l text-uppercase mb-0">
              Gucci Shoes
            </h5>
            <h3 class="banner-title ls-s text-uppercase mb-0">
              New Trend 2021
            </h3>
          </div>
        </div>

        <div class="widget widget-products">
          <h4 class="widget-title mb-3 lh-1 border-no text-capitalize">
            Related Products
          </h4>
          <div class="widget-body">
            <div
              ref="owlCarousel"
              class="owl-carousel owl-nav-top"
              data-owl-options="{
												'items': 1,
												'loop': true,
												'nav': true,
												'dots': false,
												'margin': 20
											}"
            >
              <div class="products-col">
                <div class="product product-list-sm">
                  <figure class="product-media">
                    <a href="product.html">
                      <img
                        :src="`${$baseUrl}/images/shop/product-widget1.jpg`"
                        alt="product"
                        width="100"
                        height="114"
                      />
                    </a>
                  </figure>
                  <div class="product-details">
                    <h3 class="product-name">
                      <a href="product.html">Fashionable Orginal Trucker</a>
                    </h3>
                    <div class="product-price">
                      <span class="price">$78.64</span>
                    </div>
                    <div class="ratings-container">
                      <div class="ratings-full">
                        <span class="ratings" style="width: 40%"></span>
                        <span class="tooltiptext tooltip-top"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product product-list-sm">
                  <figure class="product-media">
                    <a href="product.html">
                      <img
                        :src="`${$baseUrl}/images/shop/product-widget2.jpg`"
                        alt="product"
                        width="100"
                        height="100"
                      />
                    </a>
                  </figure>
                  <div class="product-details">
                    <h3 class="product-name">
                      <a href="product.html">Men Summer Sneaker</a>
                    </h3>
                    <div class="product-price">
                      <span class="price">$79.45</span>
                    </div>
                    <div class="ratings-container">
                      <div class="ratings-full">
                        <span class="ratings" style="width: 60%"></span>
                        <span class="tooltiptext tooltip-top"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product product-list-sm">
                  <figure class="product-media">
                    <a href="product.html">
                      <img
                        :src="`${$baseUrl}/images/shop/product-widget3.jpg`"
                        alt="product"
                        width="100"
                        height="100"
                      />
                    </a>
                  </figure>
                  <div class="product-details">
                    <h3 class="product-name">
                      <a href="product.html">Season Sports Cap</a>
                    </h3>
                    <div class="product-price">
                      <span class="price">$64.27</span>
                    </div>
                    <div class="ratings-container">
                      <div class="ratings-full">
                        <span class="ratings" style="width: 20%"></span>
                        <span class="tooltiptext tooltip-top"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Products Col -->
              <div class="products-col">
                <div class="product product-list-sm">
                  <figure class="product-media">
                    <a href="product.html">
                      <img
                        :src="`${$baseUrl}/images/shop/product-widget1.jpg`"
                        alt="product"
                        width="100"
                        height="114"
                      />
                    </a>
                  </figure>
                  <div class="product-details">
                    <h3 class="product-name">
                      <a href="product.html">Fashionable Orginal Trucker</a>
                    </h3>
                    <div class="product-price">
                      <span class="price">$78.64</span>
                    </div>
                    <div class="ratings-container">
                      <div class="ratings-full">
                        <span class="ratings" style="width: 40%"></span>
                        <span class="tooltiptext tooltip-top"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product product-list-sm">
                  <figure class="product-media">
                    <a href="product.html">
                      <img
                        :src="`${$baseUrl}/images/shop/product-widget2.jpg`"
                        alt="product"
                        width="100"
                        height="100"
                      />
                    </a>
                  </figure>
                  <div class="product-details">
                    <h3 class="product-name">
                      <a href="product.html">Men Summer Sneaker</a>
                    </h3>
                    <div class="product-price">
                      <span class="price">$79.45</span>
                    </div>
                    <div class="ratings-container">
                      <div class="ratings-full">
                        <span class="ratings" style="width: 60%"></span>
                        <span class="tooltiptext tooltip-top"></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="product product-list-sm">
                  <figure class="product-media">
                    <a href="product.html">
                      <img
                        :src="`${$baseUrl}/images/shop/product-widget3.jpg`"
                        alt="product"
                        width="100"
                        height="100"
                      />
                    </a>
                  </figure>
                  <div class="product-details">
                    <h3 class="product-name">
                      <a href="product.html">Season Sports Cap</a>
                    </h3>
                    <div class="product-price">
                      <span class="price">$64.27</span>
                    </div>
                    <div class="ratings-container">
                      <div class="ratings-full">
                        <span class="ratings" style="width: 20%"></span>
                        <span class="tooltiptext tooltip-top"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Products Col -->
            </div>
          </div>
        </div>
        <!-- End Widget Products -->
      </div>
    </div>
  </aside>
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