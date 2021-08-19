<template>
  <div v-show="show">
    <div class="mfp-bg mfp-fade mfp-ready mfp-product"></div>
    <div
      @click="overlay"
      class="
        mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-fade mfp-ready mfp-product
      "
      tabindex="-1"
      style="overflow: hidden auto"
    >
      <div class="mfp-container mfp-ajax-holder mfp-s-ready">
        <div class="mfp-content">
          <div
            ref="wrapper"
            v-if="!isEmpty(product)"
            class="
              product
              row
              product-popup
              overlay-popup
              product-single
              is-quickview
            "
          >
            <div class="col-md-6">
              <quickview-gallery :images="product.gallery.images" />
            </div>
            <div class="col-md-6">
              <quickview-detail
                :attributesAfterValidation="attributesAfterValidation"
                :selectedAllVariants="selectedAllVariants"
                :availableQuantity="availableQuantity"
                :selectVariants="selectVariants"
                :product="product"
                :_price="_price"
                @update:variant="toggleVariations"
                @clear:variant="clearVariations"
                @add-cart="preAddCart"
              />
            </div>
            <button
              @click="show = false"
              title="Close (Esc)"
              type="button"
              class="mfp-close"
            >
              <span>×</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { wait } from "@/helpers.js";
import isEmpty from "lodash-es/isEmpty";
import InteractsWithProduct from "@/Mixins/InteractsWithProduct.vue";
import QuickviewGallery from "@/Shared/Slider/QuickviewGallery.vue";
import QuickviewDetail from "@/Shared/Popup/Quickview/Detail.vue";
import InteractsWithPopup from "@/Mixins/InteractsWithPopup.vue";

export default {
  mixins: [InteractsWithProduct, InteractsWithPopup],

  components: { QuickviewGallery, QuickviewDetail },

  data() {
    return {
      show: false,
    };
  },

  mounted() {
    this.$EMITTER.on("show-popup:quickview", (product) => {
      this.show = true;
      // product changed
      product.id !== this.product.id && this.showNewProduct(product);
    });

    this.$EMITTER.on("hide-popup:quickview", () => (this.show = false));
  },

  methods: {
    isEmpty,

    showNewProduct(product) {
      // empty product để template re render và mất đi gallery cũ
      // reset value
      this.product = {};
      this.variant = {};
      this.selectVariants = {};
      this.attributes = [];
      this.variants = [];

      if (!product.has_variants) {
        return wait().then(() => (this.product = product));
      }

      this.getAttributesByProductId(product.id).then((attributes) => {
        this.attributes = attributes;
        this.product = product;
      });

      this.getVariantsByProductId(product.id).then((variants) => {
        this.variants = variants;
      });
    },

    preAddCart(quantity) {
      this.addCart(quantity, () => {
        // on added cart
        this.$EMITTER.emit("hide-popup:quickview");

        const cart = this.getBySku(this.variant.sku || this.product.sku);

        this.showMiniPopupAddedCart(cart, quantity);
      });
    },
  },
};
</script>

