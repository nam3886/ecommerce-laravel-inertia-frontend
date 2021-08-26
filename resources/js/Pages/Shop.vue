<template>
  <main class="main">
    <breadcrumb />

    <div class="page-content mb-10 pb-2">
      <div class="container">
        <banner />
        <!-- End Shop banner-->
        <brand />
        <!-- End Brand -->
        <category />
        <!-- End Category icon -->
        <tool-box />
        <!-- End Toolbox -->
        <div class="select-items">
          <a href="#" class="filter-clean text-primary">Clean All</a>
        </div>
        <div class="row product-wrapper cols-xl-5 cols-lg-4 cols-md-3 cols-2">
          <div
            v-for="(product, index) in products.data"
            :key="index"
            class="product-wrap"
          >
            <product :product="product" />
          </div>
        </div>
        <!-- End Product -->
        <pagination :meta="products.meta" />
      </div>
    </div>

    <Head title="Products" />
  </main>
</template>

<script>
import Layout from "@/Layouts/AppLayout/index.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Breadcrumb from "@/Shared/Breadcrumb.vue";
import Product from "@/Shared/ProductElement/Default.vue";
import Pagination from "@/Shared/Partials/Shop/Pagination.vue";
import ToolBox from "@/Shared/Partials/Shop/ToolBox.vue";
import Category from "@/Shared/Partials/Shop/Category.vue";
import Brand from "@/Shared/Partials/Shop/Brand.vue";
import Banner from "@/Shared/Partials/Shop/Banner.vue";
import "@r/css/style.css";

export default {
  layout: Layout,

  components: {
    Head,
    Breadcrumb,
    Product,
    Pagination,
    ToolBox,
    Category,
    Brand,
    Banner,
  },

  props: ["products"],
};
</script>
