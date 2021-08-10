<template>
  <ul class="product-nav">
    <li class="product-nav-prev">
      <link-slug :slug="products[0].slug">
        <i class="d-icon-arrow-left"></i> Prev
        <span class="product-nav-popup">
          <img
            :src="products[0].gallery.avatar.url"
            :alt="products[0].gallery.avatar.name"
            width="110"
            height="123"
          />
          <span class="product-name">{{ products[0].name }}</span>
        </span>
      </link-slug>
    </li>
    <li class="product-nav-next">
      <link-slug :slug="products[1].slug">
        Next <i class="d-icon-arrow-right"></i>
        <span class="product-nav-popup">
          <img
            :src="products[1].gallery.avatar.url"
            :alt="products[1].gallery.avatar.name"
            width="110"
            height="123"
          />
          <span class="product-name">{{ products[1].name }}</span>
        </span>
      </link-slug>
    </li>
  </ul>
</template>

<script>
import LinkSlug from "@/Shared/ProductElement/LinkSlug.vue";

export default {
  props: ["products"],

  components: { LinkSlug },
};
</script>

<style>
</style>