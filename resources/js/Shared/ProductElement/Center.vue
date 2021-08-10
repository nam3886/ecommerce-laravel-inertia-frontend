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
      <product-label :flag="product.flag" :discount="product.discount" />
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
      <div class="product-price">
        <ins v-if="product.discount" class="new-price">
          {{ product.price_after_discount_format }}
        </ins>
        <del v-if="product.discount" class="old-price">
          {{ product.price_format }}
        </del>
        <span v-else class="price">
          {{ product.price_after_discount_format }}
        </span>
      </div>
      <div class="ratings-container">
        <div class="ratings-full">
          <span class="ratings" style="width: 60%"></span>
          <span class="tooltiptext tooltip-top"></span>
        </div>
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

export default {
  props: ["product"],

  components: { LinkSlug, ProductLabel, ButtonQuickview, ButtonAddCart },
};
</script>