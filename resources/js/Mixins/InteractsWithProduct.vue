<script>
import axios from "axios";
import has from "lodash-es/has";
import isEmpty from "lodash-es/isEmpty";
import InteractsWithCart from "@/Mixins/InteractsWithCart.vue";
import { scrollToAlert } from "@/helpers.js";

export default {
  mixins: [InteractsWithCart],

  data() {
    return {
      variant: {},
      selectVariants: {},
      // get on $page props
      product: {},
      attributes: [],
    };
  },

  computed: {
    _price() {
      return this.variant?.discount
        ? this.variant?.price_after_discount_format
        : this.variant?.price_format;
    },

    availableQuantity() {
      const cart = this.getBySku(this.variant?.sku || this.product.sku);

      const stock = this.variant?.quantity || this.product.quantity;

      return cart ? stock - cart.qty : stock;
    },

    allInCart() {
      const cart = this.getBySku(this.variant?.sku || this.product.sku);

      const stock = this.variant?.quantity || this.product.quantity;

      return cart?.qty == stock ? cart : null;
    },
  },

  methods: {
    async getVariant(combination) {
      combination = this.product.id + combination;
      // variant already exists
      if (combination === this.variant.combination) return;

      const url = this.route("api.variant.show", combination);

      const response = await axios.get(url);

      this.variant = await response.data.data;
    },

    variationCheck() {
      const selectVariants = Object.values(this.selectVariants);
      // check all item selectVariants are selected
      if (selectVariants.length !== this.attributes.length) return;

      selectVariants.sort();

      const combination = selectVariants.join("") + ":" + selectVariants.length;
      // call api get variant
      this.getVariant(combination);
    },

    toggleVariations({ id, code }) {
      // toggle item in variants
      if (has(this.selectVariants, id) && this.selectVariants[id] == code) {
        delete this.selectVariants[id];
      } else {
        this.selectVariants[id] = code;
      }

      this.variationCheck();
    },

    clearVariations() {
      this.selectVariants = {};
    },

    addCart(quantity, callback) {
      const errorMessage = this.hasErrors(quantity);

      if (errorMessage) {
        this.$page.props.flash.warning = [errorMessage];

        return scrollToAlert();
      }

      this.store(this.product.id, quantity, this.variant.sku, callback);
    },

    hasErrors(quantity) {
      let message;

      if (this.allInCart) {
        message = `Bạn đã có ${this.allInCart.qty} sản phẩm trong giỏ hàng. Không thể thêm số lượng đã chọn vào giỏ hàng vì sẽ vượt quá giới hạn mua hàng của bạn.`;
      } else if (quantity > this.availableQuantity) {
        message = `Số lượng không vượt quá ${this.availableQuantity}.`;
      } else if (this.product.has_variants && isEmpty(this.variant)) {
        message = "Vui lòng chọn thuộc tính sản phẩm.";
      }

      return message;
    },
  },
};
</script>