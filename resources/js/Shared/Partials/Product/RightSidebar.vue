<template>
  <aside
    class="
      col-xl-3 col-lg-4
      sidebar
      right-sidebar
      sidebar-fixed
      sticky-sidebar-wrapper
    "
  >
    <div class="sidebar-overlay"></div>
    <a class="sidebar-close" href="#"><i class="d-icon-times"></i></a>
    <a href="#" class="sidebar-toggle"><i class="fas fa-chevron-left"></i></a>
    <div class="sidebar-content">
      <div class="sticky-sidebar">
        <div class="widget widget-collapsible widget-vendor-info">
          <h3 class="widget-title">Vendor Info</h3>
          <ul class="widget-body filter-items">
            <li class="store-name">
              <span>Store Name:</span>
              <span class="details">{{ shop.name }}</span>
            </li>
            <!-- <li class="seller-name">
              <span>Vendor:</span><span class="details">John Doe</span>
            </li> -->
            <li class="store-address">
              <span>Address:</span>
              <span class="details">{{ shop.address }}</span>
            </li>
            <li class="clearfix">
              <span class="ratings-container">
                <span class="ratings-full" title="Rated 4.65 out of 5">
                  <span class="ratings" style="width: 90%"></span>
                  <span class="tooltiptext tooltip-top"></span>
                </span>
              </span>
              <span class="details">4.65 rating from 31 reviews</span>
            </li>
          </ul>
        </div>
        <div class="widget widget-collapsible widget-contact-vendor">
          <h3 class="widget-title">Contact Vendor</h3>
          <div class="widget-body">
            <input
              type="text"
              class="form-control"
              id="name"
              name="name"
              placeholder="Your Name"
              required=""
            />
            <input
              type="text"
              class="form-control"
              id="address"
              name="address"
              placeholder="you@example.com"
              required=""
            />
            <textarea
              id="message"
              cols="30"
              rows="6"
              class="form-control"
              placeholder="Type your message..."
              required=""
            ></textarea>
            <a href="#" class="btn btn-dark btn-rounded">Send Message</a>
          </div>
        </div>
        <div class="widget widget-products">
          <h4 class="widget-title lh-1 border-no text-capitalize">
            Vendor's Products
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
              <div
                v-for="(products, index) in ownProductCarousel"
                :key="index"
                class="products-col"
              >
                <product
                  v-for="(product, index) in products"
                  :key="index"
                  :product="product"
                  :class="{ 'mb-0': index == products.length - 1 }"
                />
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
import isArray from "lodash-es/isArray";
import Riode from "@/Riode/";
import Product from "@/Shared/ProductElement/MiniCenter.vue";

export default {
  components: { Product },

  props: ["shop", "ownProducts"],

  computed: {
    ownProductCarousel() {
      const itemInOneSlide = 3;

      return this.ownProducts.reduce(function (carry, product, index) {
        index = Math.floor(index / itemInOneSlide);

        if (!isArray(carry[index])) {
          carry[index] = [];
        }

        carry[index].push(product);

        return carry;
      }, {});
    },
  },

  mounted() {
    // Initialize owl carousel
    Riode.slider(this.$refs.owlCarousel);
  },
};
</script>