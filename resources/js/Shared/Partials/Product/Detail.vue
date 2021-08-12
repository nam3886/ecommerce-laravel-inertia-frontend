<template>
  <div ref="wrapper" class="product-details">
    <div class="product-navigation">
      <ul class="breadcrumb breadcrumb-lg">
        <li>
          <a href="demo1.html"><i class="d-icon-home"></i></a>
        </li>
        <li><a href="#" class="active">Products</a></li>
        <li>Right Sidebar</li>
      </ul>
      <navigation :products="related" />
    </div>
    <h1 class="product-name">{{ product.name }}</h1>
    <div class="product-meta">
      SKU: <span class="product-sku">{{ product.sku }}</span> BRAND:
      <span class="product-brand">{{ product.brand.name }}</span>
    </div>
    <price :product="product" />
    <div class="ratings-container">
      <div class="ratings-full">
        <span class="ratings" style="width: 60%"></span>
        <span class="tooltiptext tooltip-top"></span>
      </div>
      <a href="#product-tab-reviews" class="link-to-tab rating-reviews">
        ( 35 reviews )
      </a>
    </div>
    <p class="product-short-desc">
      {{ product.sub_description }}
    </p>

    <variants
      v-if="product.has_variants"
      :selectedAllVariants="selectedAllVariants"
      :attributes="attributesAfterValidation"
      :selected="selectVariants"
      :price="_price"
      @update:variant="toggleVariations"
      @clear:variant="clearVariations"
    />

    <hr class="product-divider" />

    <quantity
      :selectedAllVariants="selectedAllVariants"
      :availableQuantity="availableQuantity"
      @add-cart="preAddCart"
    />

    <hr class="product-divider mb-3" />

    <action />
  </div>
</template>

<script>
import Riode from "@/Riode/";
import InteractsWithProduct from "@/Mixins/InteractsWithProduct.vue";
import Navigation from "@/Shared/Partials/Product/Navigation.vue";
import Variants from "@/Shared/Partials/Product/Variants.vue";
import Price from "@/Shared/Partials/Product/Price.vue";
import Quantity from "@/Shared/Partials/Product/Quantity.vue";
import Action from "@/Shared/Partials/Product/Action.vue";
import { scrollToAlert } from "@/helpers.js";

export default {
  mixins: [InteractsWithProduct],

  emits: ["update:sku"],

  components: { Navigation, Variants, Price, Quantity, Action },

  props: ["related"],

  watch: {
    variant: {
      deep: true,
      handler(variant) {
        this.$emit("update:sku", variant.sku);
      },
    },
  },

  created() {
    this.product = this.$page.props.product.data;

    if (!this.product.has_variants) return;

    this.getAttributesByProductId(this.product.id).then((attributes) => {
      this.attributes = attributes;
    });

    this.getVariantsByProductId(this.product.id).then((variants) => {
      this.variants = variants;
    });
  },

  mounted() {
    // Initialize ProductSinglePage
    Riode.initProductSinglePage(".product-single.not-quickview");
  },

  methods: {
    preAddCart(quantity) {
      this.addCart(quantity, () => {
        // on added cart
        scrollToAlert();
      });
    },
  },
};
</script>