<template>
  <div class="product text-center">
    <figure class="product-media">
      <link-slug :slug="product.slug">
        <img
          :src="product.gallery.avatar.url"
          :alt="product.gallery.avatar.name"
          width="220"
          height="245"
          style="background-color: #f2f3f5"
        />
      </link-slug>
      <product-label
        :flag="product.flag"
        :discount="product.discount"
        :quantity="product.quantity"
      />
      <div class="product-action-vertical">
        <button-add-cart :_product="product" />
        <a
          href="#"
          class="btn-product-icon btn-wishlist"
          title="Add to wishlist"
          ><i class="d-icon-heart"></i
        ></a>
      </div>
      <div class="product-action">
        <button-quickview :product="product" class="btn-product btn-quickview">
          Quick View
        </button-quickview>
      </div>
    </figure>
    <div class="product-details">
      <div class="product-cat">
        <a href="shop-grid-3cols.html">Bags & Backpacks</a>
      </div>
      <h3 class="product-name">
        <link-slug :slug="product.slug">
          {{ product.name }}
        </link-slug>
      </h3>
      <price :product="product" />
      <div class="ratings-container">
        <rating width="60%" />
        <link-slug :slug="product.slug" class="rating-reviews">
          ( 16 reviews )
        </link-slug>
      </div>
    </div>
  </div>
</template>

<script>
import LinkSlug from "@/Shared/ProductElement/LinkSlug.vue";
import ProductLabel from "@/Shared/ProductElement/Label.vue";
import ButtonQuickview from "@/Shared/ProductElement/ButtonQuickview.vue";
import ButtonAddCart from "@/Shared/ProductElement/ButtonAddCart.vue";
import Price from "@/Shared/ProductElement/Price.vue";
import Rating from "@/Shared/ProductElement/Rating.vue";

export default {
  props: ["product"],

  components: {
    LinkSlug,
    ProductLabel,
    ButtonQuickview,
    ButtonAddCart,
    Price,
    Rating,
  },
};
</script>