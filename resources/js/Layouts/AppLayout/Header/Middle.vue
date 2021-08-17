<template>
  <div class="header-middle sticky-header fix-top sticky-content">
    <div class="container">
      <div class="header-left">
        <a href="#" class="mobile-menu-toggle">
          <i class="d-icon-bars2"></i>
        </a>
        <Link :href="route('home')" class="logo">
          <img
            :src="`${$BASE_URL}/images/logo.png`"
            alt="logo"
            width="153"
            height="44"
          />
        </Link>
        <!-- End Logo -->

        <div class="header-search hs-simple">
          <form action="#" class="input-wrapper">
            <input
              type="text"
              class="form-control"
              name="search"
              autocomplete="off"
              placeholder="Search..."
              required
            />
            <button class="btn btn-search" type="submit">
              <i class="d-icon-search"></i>
            </button>
          </form>
        </div>
        <!-- End Header Search -->
      </div>
      <div class="header-right">
        <a href="tel:#" class="icon-box icon-box-side">
          <div class="icon-box-icon mr-0 mr-lg-2">
            <i class="d-icon-phone"></i>
          </div>
          <div class="icon-box-content d-lg-show">
            <h4 class="icon-box-title">Call Us Now:</h4>
            <p>0(800) 123-456</p>
          </div>
        </a>
        <span class="divider"></span>
        <a href="wishlist.html" class="wishlist">
          <i class="d-icon-heart"></i>
        </a>
        <span class="divider"></span>
        <quick-view-cart />
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import QuickViewCart from "@/Layouts/AppLayout/Header/QuickViewCart.vue";

export default {
  components: { Link, QuickViewCart },
};
</script>