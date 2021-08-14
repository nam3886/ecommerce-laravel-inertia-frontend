<template>
  <div class="product product-list-sm text-center">
    <figure class="product-media">
      <link-slug :slug="product.slug">
        <img
          :src="product.gallery.avatar.url"
          :alt="product.gallery.avatar.name"
          width="165"
          height="184"
        />
      </link-slug>
    </figure>
    <div class="product-details">
      <h3 class="product-name">
        <link-slug :slug="product.slug">Girl's Grey Schoolbag</link-slug>
      </h3>
      <price :product="product" />
      <div class="ratings-container">
        <rating width="100%" />
      </div>
    </div>
  </div>
</template>

<script>
import LinkSlug from "@/Shared/ProductElement/LinkSlug.vue";
import ProductLabel from "@/Shared/ProductElement/Label.vue";
import Price from "@/Shared/ProductElement/Price.vue";
import Rating from "@/Shared/ProductElement/Rating.vue";

export default {
  props: ["product"],

  components: { LinkSlug, ProductLabel, Price, Rating },
};
</script>

