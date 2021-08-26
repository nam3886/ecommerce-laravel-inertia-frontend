<template>
  <a
    @click.prevent="preAddCart"
    href="#"
    class="btn-product-icon btn-cart"
    data-toggle="modal"
    data-target="#addCartModal"
    title="Add to cart"
  >
    <i v-if="_product.has_variants" class="d-icon-search"></i>
    <i v-else class="d-icon-bag"></i>
  </a>
</template>

<script>
import isEmpty from "lodash-es/isEmpty";
import InteractsWithProduct from "@/Mixins/InteractsWithProduct.vue";

export default {
  mixins: [InteractsWithProduct],

  props: ["_product"],

  methods: {
    preAddCart() {
      if (this._product.has_variants) {
        return this.$EMITTER.emit("show-popup:quickview", this._product);
      }

      this.product = this._product;

      this.addCart(1, () => {
        // on added cart
        const cart = this.getBySku(this.product.sku);

        this.showMiniPopupAddedCart(cart, 1);
      });

      const messages = this.$page.props.flash.warning;

      if (!isEmpty(messages)) {
        this.$EMITTER.emit("show-popup:message", messages.join("; "));
        this.$page.props.flash.warning = [];
      }
    },
  },
};
</script>
